angular.module('UsuarioFincaCtrl', [])
    .controller('UsuarioFincaCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'DatosUsuario', 
        function($scope, $rootScope, $http, $injector, $mdDialog, DatosUsuario) {
            
            var Ctrl = $scope;
            var Rs = $rootScope;
            Ctrl.Cancel = $mdDialog.cancel;
            Ctrl.UsuarioFinca = DatosUsuario;

            $http.post('api/fincas/usuario', { 
                usuario: Ctrl.UsuarioFinca.id
            }).then( res => {
                Ctrl.Fincas = res.data;
            });

            $http.post ('api/lista/listacompleta', { 
                id: 3
            }).then((r)=>{
                Ctrl.Municipios = r.data;
			});

            $http.post ('api/lista/listacompleta', { 
                id: 2
            }).then((r)=>{
                Ctrl.Departamentos = r.data;
                // console.log(Ctrl.Departamentos);
			});

            $http.post ('api/lista/listacompleta', { 
                id: 6
            }).then((r)=>{
                Ctrl.TipoCultivo = r.data;
			});

            $http.post ('api/lista/listacompleta', { 
                id: 7
            }).then((r)=>{
                Ctrl.TipoSuelo = r.data;
			});

            Ctrl.guardarFinca = (F) => {
                $http.post('api/fincas/actualizar', {
                    Datos: F
                });
            }

            Ctrl.nuevaFinca = (F) => {
                $http.post('api/fincas/crear', {
                    Datos: F,
                    usuario: Ctrl.UsuarioFinca.id
                });
                Ctrl.Cancel();
            }
       }
    ]
);