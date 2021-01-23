angular.module('SolicitudesDetalleCtrl', [])
    .controller('SolicitudesDetalleCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', 'Caso',
        function($scope, $rootScope, $http, $injector, $mdDialog, Caso) {

            // console.info('SolicitudesDetalleCtrl');
            var Ctrl = $scope;
            var Rs = $rootScope;

            Ctrl.Caso = angular.copy(Caso);

            Ctrl.Cancel = $mdDialog.cancel;

            Ctrl.NovedadesCRUD = $injector.get('CRUD').config({
                base_url: '/api/casos/novedades',
                limit: 1000,
                add_append: 'refresh',
            });

            Ctrl.CasosCRUD = $injector.get('CRUD').config({
                base_url: '/api/casos/casos',
                limit: 1000,
                add_append: 'refresh',
            });

            Ctrl.TipoNovedad = {
                'Parrafo': { Nombre: 'Parrafo', icono: 'fa-align-justify' },
                'Imagen': { Nombre: 'Imagen', icono: 'fa-image' }
            }

            Ctrl.getNovedades = () => {
                Ctrl.NovedadesCRUD.setScope('elcaso', Caso.id).get();
            }

            Ctrl.getNovedades();

            Ctrl.guardarCaso = () => {
                //console.log(Ctrl.Caso);
                Ctrl.CasosCRUD.update(Ctrl.Caso);
            };

            Ctrl.crearNovedad = (tipo, texto) => {
                //console.log(tipo);
                Ctrl.NovedadesCRUD.add({
                    caso_id: Caso.id,
                    tipo: tipo,
                    novedad: texto,
                    usuario_id: Rs.Usuario.id
                });
            };
        }
    ]);