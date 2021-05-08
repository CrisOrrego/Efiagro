angular.module('MiTecnicoAmigoCtrl', [])
    .controller('MiTecnicoAmigoCtrl', ['$scope', '$rootScope', '$http', '$injector', '$mdDialog', '$state',
        function($scope, $rootScope, $http, $injector, $mdDialog, $state) {

            //console.info('MiTecnicoAmigoCtrl');
            var Ctrl = $scope;
            var Rs = $rootScope;

            // Por defecto carga la subseccion Inicio (MiTecnicoAmigo) :: Luigi
            Ctrl.Subseccion = 'Inicio';
            Ctrl.PalabrasClave = [];
            Ctrl.Cancel = $mdDialog.cancel;
             //INICIO DEV ANGELICA
             Ctrl.SelectedKey = false;
             Ctrl.key = "";
             Ctrl.keys= [];
             Ctrl.ArticulosBuscados = [];
 

            $http.post('api/articulos/obtener', {}).then(
                r => {
                    Ctrl.Articulos = r.data;
                    //Inicio Dev Angélica -- seleccionar las palabras claves
                    let keys = [];

                    Ctrl.Articulos.forEach(function(articulo) {
                        if (articulo.palabras_clave) {
                            keys.push(...articulo.palabras_clave.split(","));
                        }
                    });
                    keys = keys.sort().filter(function(item, pos, ary) {
                        return !pos || item != ary[pos - 1];
                    });

                    Ctrl.PalabrasClave = keys;
                });
            //Fin Dev Angélica 

            Ctrl.abrirArticulo = (A) => {
                $mdDialog.show({
                    templateUrl: 'Frag/MiTecnicoAmigo.ArticuloDiag',
                    controller: 'ArticuloDiagCtrl',
                    locals: { Articulo: A },
                    fullscreen: false,
                });
            };

            //Casos :: Inicia Luigi
            // Obtener toda la información y metodos de CASOS
            Ctrl.CasosCRUD = $injector.get('CRUD').config({
                base_url: '/api/casos/casos',
                limit: 1000,
                add_append: 'refresh',
                query_with: ['novedades', 'solicitante'],
                order_by: []
            });

            Ctrl.getCasos = () => {

                //Inicio Dev Angélica
                //Filtra el tipo (sólo muestra los casos que deben aparecer en pantalla)-->'Consulta General', 'Apoyo Tecnico', 'Contar Experiencia' [ver archivo Caso.php]
                Ctrl.CasosCRUD.setScope('tipo');

                Ctrl.CasosCRUD.get();
            
                //Fin Dev Angélica
            }
            Ctrl.getCasos();
            //Casos :: Finaliza Luigi

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
                    Ctrl.navegarA('Solicitudes');
                });
            };

            //INICIO DEV ANGÉLICA
            //yo como usuario puedo ver todas las solicitudes o solo las mias?
            //Si entro como admin debo ver las solicitudes de todos, con un filtro--> las que si y no tienen respuesta
            //Si el usuario navega por web que no vea el boton de SMS
            Ctrl.crearCasoTelefonico = (medio) => {
                var NuevoCaso = {
                    titulo: 'Boton Contacto',
                    solicitante_id: Rs.Usuario.id,
                    tipo: medio,
                    asignados: '[]'
                };
                alert('Inicia llamado al WS')
                Ctrl.CasosCRUD.add(NuevoCaso);
            };
            //FIN DEV ANGELICA

            // Novedad Caso :: Inicia Luigi
            // Abrir el modal para la revisión y creación de novedades por Caso
            Ctrl.novedadesCaso = (C) => {
                $mdDialog.show({
                    templateUrl: 'Frag/MiTecnicoAmigo.MiTecnicoAmigo_SolicitudesDetalleDiag',
                    controller: 'SolicitudesDetalleCtrl',
                    locals: {
                        Caso: C
                    },
                });
            };
            // Novedad Caso :: Finaliza Luigi

            //INICIO DEV ANGÉLICA ---> Filtro de búsqueda 
            Ctrl.suppressSpecialCharacters = (word) => { // funcion para buscar con tiltes
                return word.toLowerCase().replace(" de ", " ")
                .replace(" en ", " ")
                .replace(" para ", " ")
                .replace(" por ", " ")
                .replace(" la ", " ")
                .replace("é", "e")
                .replace("á", "a")
                .replace("í", "i")
                .replace("ó", "o")
                .replace("ú", "u")
                .replace(" y ", " ");
            }
            Ctrl.searchChange = function() {
                let filtro = Ctrl.filtroArticulos;
                if (!filtro) return Ctrl.Buscando = false;
                filtro = Ctrl.suppressSpecialCharacters(filtro);


                if (filtro == "") return Ctrl.Buscando = false;

                let keys = filtro.split(" ");
                Ctrl.keys = [];//nuevo
                var ArticulosBuscados = [];
                Ctrl.Buscando = true;
                Ctrl.Articulos.forEach(function(articulo) {
                    articulo.contador = 0;
                    keys.forEach(function(key) {
                        
                        if (Ctrl.suppressSpecialCharacters(articulo.titulo).indexOf(key) > 0) {
                            articulo.contador++;
                        }
                    });
                    // Recorre cada una de las palabras digitadas en el filtro
                keys.forEach(function (palabra){
                    // Separa cada una de las pabras clave del artuculo
                    let keys = articulo.palabras_clave && articulo.palabras_clave.split(",");
                // console.log(keys);
                    // Buscamos si la palabra del filtro esta en la lista de palabras clave
                    if (keys && keys.includes(palabra)) {
                        articulo.contador++; 
                        Ctrl.SelectedKey = true;
                        Ctrl.keys.push(palabra);
                        // console.log(articulo.palabras_clave, palabra);
                    }
                });

                    if (articulo.contador > 0) ArticulosBuscados.push(articulo);
                });

                Ctrl.ArticulosBuscados = ArticulosBuscados;
            };
            //FIN DEV ANGÉLICA

            //INICIO DEV ANGÉLICA -- Search key words
            Ctrl.searchKeyWords = (key) => {
                var ArticulosBuscados = [];
                Ctrl.Buscando = true;
                Ctrl.SelectedKey = true;
                Ctrl.key = key;
                Ctrl.Articulos.forEach(function(articulo) {
                    articulo.contador = 0;
                    // console.log(articulo.palabras_clave);
                    if (articulo.palabras_clave && articulo.palabras_clave.indexOf(key) >= 0) {
                        articulo.contador++;
                    }

                    if (articulo.contador > 0) ArticulosBuscados.push(articulo);
                })

                Ctrl.ArticulosBuscados = ArticulosBuscados;
            };

            Ctrl.cleanFilter = () => {
                Ctrl.SelectedKey = false;
                Ctrl.key = "";
                Ctrl.Buscando = false;
                Ctrl.ArticulosBuscados = [];
                Ctrl.keys = [];
            }

            //FIN DEV ANGÉLICA

            // Navegar :: Inicia Luigi
            // Metodo para navegar en opciones de Mi Tecnico Amigo
            Ctrl.navegarA = (s) => {
                $state.go('Home.Seccion.Subseccion', { subseccion: s });
            };
            // Navegar :: Finaliza Luigi
        }
    ]);
