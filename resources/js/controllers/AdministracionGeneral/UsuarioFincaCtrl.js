angular.module('UsuarioFincaCtrl', ['ngFileUpload'])//ngFileUpload
    .controller('UsuarioFincaCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'DatosUsuario', 
        function($scope, $rootScope, $http, $injector, $mdDialog, DatosUsuario) {
            
            var Ctrl = $scope;
            var Rs = $rootScope;
            Ctrl.Cancel = $mdDialog.cancel;
            Ctrl.UsuarioFinca = DatosUsuario;

            //INICIO DEV ANGÉLICA
            //Para leer un archivo de excel
            Ctrl.SelectFile = function (file) {
                Ctrl.SelectedFile = file;
            };
            Ctrl.Upload = (L) => {
                // debugger;
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
                if (regex.test(Ctrl.SelectedFile.name.toLowerCase())) {
                    if (typeof (FileReader) != "undefined") {
                        var reader = new FileReader();
                        //For Browsers other than IE.
                        if (reader.readAsBinaryString) {
                            reader.onload = function (e) {
                                Ctrl.ProcessExcel(e.target.result, L);
                            };
                            reader.readAsBinaryString(Ctrl.SelectedFile);
                        } else {
                            //For IE Browser.
                            reader.onload = function (e) {
                                var data = "";
                                var bytes = new Uint8Array(e.target.result);
                                for (var i = 0; i < bytes.byteLength; i++) {
                                    data += String.fromCharCode(bytes[i]);
                                }
                                Ctrl.ProcessExcel(data, L);
                            };
                            reader.readAsArrayBuffer(Ctrl.SelectedFile);
                        }
                    } else {
                        $window.alert("This browser does not support HTML5.");
                    }
                } else {
                    $window.alert("Please upload a valid Excel file.");
                }
            };
     
            Ctrl.ProcessExcel = function (data, L) {
                // debugger;
                //Read the Excel File data.
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });
     
                //Fetch the name of First Sheet.
                var firstSheet = workbook.SheetNames[0];
     
                //Read all rows from First Sheet into an JSON array.
                var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet]);
                L.coordenadas = '';
                excelRows.forEach(element => {
                    console.log(element.lat);
                    L.coordenadas += '{"lat":' + element.lat + ', "lng":' + element.lng + '},';  
                    
                });
                L.coordenadas = '[' + L.coordenadas + ']';
            };
            //FIN DEV ANGELICA
            
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
                Ctrl.Cancel();
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