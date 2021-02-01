angular.module('MiTecnicoAmigoCtrl', [])
    .controller('MiTecnicoAmigoCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog',
        function($scope, $rootScope, $http, $injector, $mdDialog) {

            //console.info('MiTecnicoAmigoCtrl');
            var Ctrl = $scope;
            var Rs = $rootScope;

            Ctrl.Subseccion = 'Articulos';
            Ctrl.Subseccion = 'Solicitudes';

            Ctrl.Cancel = $mdDialog.cancel;
            Ctrl.Buscando = false;

            $http.post('api/articulos/obtener', {}).then(r => {
                Ctrl.Articulos = r.data;
                // Ctrl.abrirArticulo(Ctrl.Articulos[3]); //FIX
            })

            Ctrl.abrirArticulo = (A) => {
                $mdDialog.show({
                    templateUrl: 'Frag/MiTecnicoAmigo.ArticuloDiag',
                    controller: 'ArticuloDiagCtrl',
                    locals: { Articulo: A },
                    fullscreen: false,
                });
            }

            //Casos
            Ctrl.CasosCRUD = $injector.get('CRUD').config({
                base_url: '/api/casos/casos',
                limit: 1000,
                add_append: 'refresh',
                query_with: ['novedades', 'solicitante'],
                order_by: []
            })

            Ctrl.getCasos = () => {
                Ctrl.CasosCRUD.get();
            }

            Ctrl.getCasos();

            Ctrl.crearCaso = () => {
                var OpcionesTipo = [
                    ['Tengo una Duda General', 'Consulta General'],
                    ['Necesito Ayuda Técnica', 'Apoyo Técnico'],
                    ['Quiero Contar Una Experiencia', 'Contar Experiencia']
                ];

                Rs.BasicDialog({
                    Flex: 30,
                    Title: 'Crear Nueva Solicitud',
                    Fields: [
                        { Nombre: '¿En Qué Puedo Ayudarte?', Value: 'Tengo una Duda General', Type: 'simplelist', List: OpcionesTipo.map(a => a[0]), Required: true },
                        { Nombre: 'Describe el Caso', Value: '', Type: 'textarea', Required: true, opts: { rows: 3 } }
                    ],
                    Confirm: { Text: 'Crear Solicitud' },
                }).then(r => {
                    if (!r) return;

                    var NuevoCaso = {
                        titulo: r.Fields[1].Value,
                        solicitante_id: Rs.Usuario.id,
                        tipo: OpcionesTipo.find(a => a[0] == r.Fields[0].Value)[1],
                        asignados: '[]'
                    };

                    Ctrl.CasosCRUD.add(NuevoCaso);


                });
            }

            // Inicia Codigo Luigi
            Ctrl.novedadesCaso = (C) => {
                $mdDialog.show({
                    templateUrl: 'Frag/MiTecnicoAmigo.MiTecnicoAmigo_SolicitudesDetalleDiag',
                    controller: 'SolicitudesDetalleCtrl',
                    locals: {
                        Caso: C
                    },
                    //scope: Ctrl.$update()
                });
            };
            // Finaliza Codigo Luigi

            Ctrl.searchChange = function() {
                let filtro = Ctrl.filtroArticulos;
                if (!filtro) return Ctrl.Buscando = false;
                filtro = filtro.toLowerCase().replace(" de ", " ")
                    .replace(" en ", " ")
                    .replace(" para ", " ")
                    .replace(" por ", " ")
                    .replace(" la ", " ");

                if (filtro == "") return Ctrl.Buscando = false;

                let keys = filtro.split(" ");
                var ArticulosBuscados = [];
                Ctrl.Buscando = true;
                Ctrl.Articulos.forEach(function(articulo) {
                    articulo.contador = 0;
                    keys.forEach(function(key) {
                        if (articulo.titulo.toLowerCase().indexOf(key) > 0) {
                            articulo.contador++;
                        }
                    });

                    if (articulo.contador > 0) ArticulosBuscados.push(articulo);
                })

                Ctrl.ArticulosBuscados = ArticulosBuscados;
            };
            //FIN DEV ANGÉLICA
        }
    ]);