angular.module('HomeCtrl', [])
    .controller('HomeCtrl', ['$scope', '$rootScope', '$http', '$state', '$mdDialog', '$location', 'appFunctions',
        function($scope, $rootScope, $http, $state, $mdDialog, $location, appFunctions) {

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
            };

            Ctrl.obtenerSecciones = () => {
                Ctrl.logoInicio = true;
                $http.post('api/main/obtener-secciones', {})
                    .then(r => {
                        Rs.Secciones = r.data;
                    });
            };
            Ctrl.obtenerSecciones();

            // Gestion del Estado
            Rs.cambioEstado = function() {
                Rs.Estado = $state.current;
                Rs.Estado.ruta = $location.path().split('/');
            };

            Rs.navegarSubseccion = (Seccion, Subseccion) => {
                $state.go('Home.Seccion.Subseccion', { 
                    seccion: Seccion, 
                    subseccion: Subseccion 
                });
            };
            console.log(Rs.Usuario);
            
            // Función para actualizar un campo en la tabla del usuario.
            Rs.actualizarUsuario = ( campo, valor ) => {
                $http.post('api/usuario/actualizarcampo', {
                    usuario: Rs.Usuario['id'],
                    // usuario: 1,
                    campo: campo, 
                    valor: valor
                }).then( () => {
                    $state.reload();
                });
            }

            Rs.$on("$stateChangeSuccess", Rs.cambioEstado);

            Rs.cambioEstado();
        }
    ]);