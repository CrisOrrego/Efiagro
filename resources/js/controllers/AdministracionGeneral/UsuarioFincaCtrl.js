angular.module('UsuarioFincaCtrl', [])
    .controller('UsuarioFincaCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'DatosUsuario', 
        function($scope, $rootScope, $http, $injector, $mdDialog, DatosUsuario) {
            
            var Ctrl = $scope;
            var Rs = $rootScope;
            Ctrl.Cancel = $mdDialog.cancel;
            Ctrl.UsuarioFinca = DatosUsuario;
            
            // Cargar las fincas del usuario seleccionado
            $http.post('api/fincas/usuario', { 
                usuario: Ctrl.UsuarioFinca.id
            }).then( res => {
                if ( res.data.length > 0 ) {
                    Ctrl.Fincas = res.data;
                    // console.log(Ctrl.Fincas);
                    Ctrl.cargarLotes( Ctrl.Fincas[0] );
                }
            });

            // Cargar los lotes de la finca seleccionada
            var fincaDefault = 0;
            Ctrl.cargarLotes = (F) => {
                $http.post('api/lotes/finca', { 
                    finca: F.id
                }).then( res => {
                    Ctrl.Lotes = res.data;
                    //console.log(F);
                    
                    // calcular zonas
                    calcularZona(F);
                });
                fincaDefault = F;
            };

            // Obtener el listado de las lineas productivas
            $http.post('api/lineasproductivas/obtener', {})
                .then( res => {
                    Ctrl.Lineasproductivas = res.data;
                });

            // Obtener el listado de las labores.
            $http.post('api/labores/obtener', {})
                .then( res => {
                    Ctrl.Labores = res.data;
                });
            
            // Obtener los datos de la lista 3: Municipios
            $http.post ('api/lista/listacompleta', { 
                id: 3
            }).then((r)=>{
                Ctrl.Municipios = r.data;
			});

            // Obtener los datos de la lista 2: Departamentos
            $http.post ('api/lista/listacompleta', { 
                id: 2
            }).then((r)=>{
                Ctrl.Departamentos = r.data;
			});

            // Obtener los datos de la lista 6: Tipo de Cultivo
            $http.post ('api/lista/listacompleta', { 
                id: 5
            }).then((r)=>{
                Ctrl.TipoCultivo = r.data;
			});

            // Obtener los datos de la lista 7: Tipos de Suelo
            $http.post ('api/lista/listacompleta', { 
                id: 4
            }).then((r)=>{
                Ctrl.TipoSuelo = r.data;
			});

            // Guardar / Actualizar los datos de la finca
            Ctrl.guardarFinca = (F) => {
                $http.post('api/fincas/actualizar', {
                    Datos: F
                });
            };
            
            // Agregar registro de finca.
            Ctrl.nuevaFinca = (F) => {
                $http.post('api/fincas/crear', {
                    Datos: F,
                    usuario: Ctrl.UsuarioFinca.id
                });
                Ctrl.Cancel();
            };

            // Guardar / Actualizar lote de la finca.
            Ctrl.guardarLote = (L) => {
                $http.post('api/lotes/actualizar', {
                    Datos: L
                });
                Ctrl.Cancel();
            };

            // Agregar registro de lote
            Ctrl.nuevoLote = (L) => {
                $http.post('api/lotes/crear', {
                    Datos:          L,
                    finca:          fincaDefault,
                    organizacion:   Ctrl.UsuarioFinca.organizacion_id
                });
                Ctrl.Cancel();
            };

            // Obtener los datos maximos y minimos por cada zona y linea productiva
            $http.post ('api/zonas/obtener', {}).then((r)=>{
                Ctrl.zonas = r.data;
			});

            Ctrl.recalcularZona = ( data ) => {
                if ( data['temperatura'] > 0 && data['humedad_relativa'] > 0 && data['precipitacion'] > 0 && data['altimetria_min'] > 0 && data['altimetria_max'] > 0 && data['brillo_solar'] > 0 ) {
                    calcularZona = ( data )
                }
                //console.log(data);
            };

            calcularZona = (Finca) => {
                // recorrer las zonas y validar los valores contra la finca, para obtener porcentajes
                zonaprimaria = [];
                angular.forEach(Ctrl.zonas, function( data ) {
                    var contadorzona = 0;

                    if ( data['temperatura_min'] <= Finca['temperatura'] && data['temperatura_max'] >= Finca['temperatura'] ) {
                        contadorzona++;
                    }
                    if ( data['humedad_relativa_min'] <= Finca['humedad_relativa'] && data['humedad_relativa_max'] >= Finca['humedad_relativa'] ) {
                        contadorzona++;
                    }
                    if ( data['precipitacion_min'] <= Finca['precipitacion'] && data['precipitacion_max'] >= Finca['precipitacion'] ) {
                        contadorzona++;
                    }
                    if ( data['altimetria_min'] <= Finca['altimetria_min'] && data['altimetria_max'] >= Finca['altimetria_min'] ) {
                        contadorzona++;
                    }
                    if ( data['altimetria_min'] <= Finca['altimetria_max'] && data['altimetria_max'] >= Finca['altimetria_max'] ) {
                        contadorzona++;
                    }
                    if ( data['brillo_solar_min'] <= Finca['brillo_solar'] && data['brillo_solar_max'] >= Finca['brillo_solar'] ) {
                        contadorzona++;
                    }
                    zonaprimaria.push({
                        'descripcion': data['descripcion'],
                        'cantidad': contadorzona,
                        'participacion': parseInt(contadorzona / 6 * 100)
                    });
                });
                zonaprimaria.reverse( (a, b) => a.participacion < b.participacion);
                var text = zonaprimaria[0].descripcion + ': Coincidencia del ' + zonaprimaria[0].participacion + '%';
                Ctrl.zp = ( zonaprimaria[0].participacion < 70 ) ? 'Subzona de ' + text : 'Zona de ' + text;
                //console.log(Ctrl.zonaprimaria);
            };
        }
    ]
);