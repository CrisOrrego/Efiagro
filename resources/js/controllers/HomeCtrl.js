angular.module('HomeCtrl', [])
    .controller('HomeCtrl', ['$scope', '$rootScope', '$http', '$state', '$mdDialog', '$location', 'appFunctions',
        function($scope, $rootScope, $http, $state, $mdDialog, $location, appFunctions) {

            var Ctrl = $scope;
            var Rs = $rootScope;

            // Controlador para validar al momento de cerrar la session del usuario.
            Ctrl.Logout = () => {
                let confirm = $mdDialog.confirm()
                    .title('¿Desea salir del aplicativo?')
                    .ok('Cerrar Sesion')
                    .cancel('Regresar');

                $mdDialog.show(confirm).then(() => {
                    $state.go('Login');
                });
            };

            // Cargar el listado de secciones
            Ctrl.obtenerSecciones = () => {
                Ctrl.logoInicio = true;
                $http.post('api/main/obtener-secciones', {}).then(r => {
                    Rs.Secciones = r.data;
                });
            };
            Ctrl.obtenerSecciones();

            // Gestion del Estado
            Rs.cambioEstado = function() {
                Rs.Estado = $state.current;
                Rs.Estado.ruta = $location.path().split('/');
            };

            // Carga del menu segund la seccion cargada
            Rs.navegarSubseccion = (Seccion, Subseccion) => {
                $state.go('Home.Seccion.Subseccion', { 
                    seccion: Seccion, 
                    subseccion: Subseccion 
                });
            };
            
            // Función para actualizar un campo en la tabla del usuario.
            Rs.actualizarUsuario = ( campo, valor ) => {
                if ( !campo || !valor )
                    return;
                
                $http.post('api/usuario/actualizarcampo', {
                    usuarioid: Rs.Usuario['id'],
                    campo: campo, 
                    valor: valor
                }).then( () => {
                    $state.reload();
                    // console.log("Recargando Pagina")
                });
            }
            
            // Validar el rol para cargar opciones de organizaciones y fincas
            // Administrador: 1 | Operaor: 2 | Soporte: 3 | Productor: 4 
            switch( parseInt(Rs.Usuario['perfil_id']) ) {
                case 1:
                    Ctrl.listaOrganizacion = false;
                    Ctrl.listaFinca = false;
                    break;
                    
                case 2:
                    Ctrl.listaOrganizacion = true;
                    Ctrl.listaFinca = false;
                    break;
                    
                case 3:
                    Ctrl.listaOrganizacion = false;
                    Ctrl.listaFinca = false;
                    break;
                    
                case 4:
                    Ctrl.listaOrganizacion = true;
                    Ctrl.listaFinca = true;
                    break;

                default:
                    Ctrl.listaOrganizacion = false;
                    Ctrl.listaFinca = false;
                    break;
                    
            }

            Rs.$on("$stateChangeSuccess", Rs.cambioEstado);

            Rs.cambioEstado();
        }
    ]);
