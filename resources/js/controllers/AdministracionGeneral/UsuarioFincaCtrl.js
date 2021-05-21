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
                    Ctrl.cargarLotes( Ctrl.Fincas[0]['id'] );
                }
            });

            // Cargar los lotes de la finca seleccionada
            var fincaDefault = 0;
            Ctrl.cargarLotes = (F) => {
                $http.post('api/lotes/finca', { 
                    finca: F
                }).then( res => {
                    Ctrl.Lotes = res.data;
                });
                fincaDefault = F;
            };

            // Obtener el liestado de las lineas productivas
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
                id: 6
            }).then((r)=>{
                Ctrl.TipoCultivo = r.data;
			});

            // Obtener los datos de la lista 7: Tipos de Suelo
            $http.post ('api/lista/listacompleta', { 
                id: 7
            }).then((r)=>{
                Ctrl.TipoSuelo = r.data;
			});

            // Guardar / Actualizar los datos de la finca
            Ctrl.guardarFinca = (F) => {
                $http.post('api/fincas/actualizar', {
                    Datos: F
                });
            }
            
            // Agregar registro de finca.
            Ctrl.nuevaFinca = (F) => {
                $http.post('api/fincas/crear', {
                    Datos: F,
                    usuario: Ctrl.UsuarioFinca.id
                });
                Ctrl.Cancel();
            }

            // Guardar / Actualizar lote de la finca.
            Ctrl.guardarLote = (L) => {
                $http.post('api/lotes/actualizar', {
                    Datos: L
                });
            }

            // Agregar registro de lote
            Ctrl.nuevoLote = (L) => {
                $http.post('api/lotes/crear', {
                    Datos:          L,
                    finca:          fincaDefault,
                    organizacion:   Ctrl.UsuarioFinca.organizacion_id
                });
                Ctrl.Cancel();
            }
       }
    ]
);