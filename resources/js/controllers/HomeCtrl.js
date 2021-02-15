angular.module('HomeCtrl', [])
    .controller('HomeCtrl', ['$scope', '$rootScope', '$http', '$state', '$mdDialog', '$location', 'appFunctions',
        function($scope, $rootScope, $http, $state, $mdDialog, $location, appFunctions) {

            //console.info('HomeCtrl');
            var Ctrl = $scope;
            var Rs = $rootScope;

            Ctrl.Logout = () => {
                let confirm = $mdDialog.confirm()
                    .title('¿Desea salir del aplicativo?')
                    .ok('Cerrar Sesion')
                    .cancel('Regresar');

                $mdDialog.show(confirm).then(() => {
                    $state.go('Login');
                });
            }


            Ctrl.obtenerSecciones = () => {
                $http.post('api/main/obtener-secciones', {}).then(r => {
                    Rs.Secciones = r.data;
                });
            }

            Ctrl.obtenerSecciones();

            //Gestion del Estado
            Rs.cambioEstado = function() {
                Rs.Estado = $state.current;
                Rs.Estado.ruta = $location.path().split('/');

                //console.log(Rs.Estado);
            };

            Rs.navegarSubseccion = (Seccion, Subseccion) => {
                $state.go('Home.Seccion.Subseccion', { seccion: Seccion, subseccion: Subseccion });
            };

            Rs.$on("$stateChangeSuccess", Rs.cambioEstado);

            Rs.cambioEstado();
        }
    ]);