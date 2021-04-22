angular
    .module("FincasCtrl", [])
    .controller("FincasCtrl", [
        "$scope",
        "$rootScope",
        "$http",
        "$injector",
        "$mdDialog",
        function($scope, $rootScope, $http, $injector, $mdDialog) {
            console.info("FincasCtrl");
            var Ctrl = $scope;
            var Rs = $rootScope;
// INICIO ANGELICA
            var TiposSuelo = [
                // "UNIDAD AMAGÁ",
                // "UNIDAD ARMENIA",
                // "UNIDAD CASCARERO",
                // "UNIDAD CARTAGENITA",
                // "UNIDAD CINCHO",
                // "UNIDAD CHANCHÓN",
                // "UNIDAD CHINCHINÁ",
                // "UNIDAD CHUSCAL",
                // "UNIDAD DOÑA JUANA",
                // "UNIDAD DOSCIENTOS",
                // "UNIDAD EL PALMAR",
                // "UNIDAD FONDESA",
                // "UNIDAD FRESNO",
                // "UNIDAD GUADALUPE",
                // "UNIDAD LA MONTAÑA",
                // "UNIDAD LIBANO",
                // "UNIDAD LLANO DE PALMAS",
                // "UNIDAD MALABAR",
                // "UNIDAD MONTENEGRO",
                // "UNIDAD NORTE",
                // "UNIDAD PERIJÁ",
                // "UNIDAD PAUJIL",
                // "UNIDAD PIENDAMÓ",
                // "UNIDAD QUINDÍO",
                // "UNIDAD ROPERO",
                // "UNIDAD SALGAR",
                // "UNIDAD SAN SIMÓN",
                // "UNIDAD SUÁREZ",
                // "UNIDAD SUROESTE",
                // "UNIDAD TABLAZO",
                // "UNIDAD TIMBÍO",
                // "UNIDAD VENECIA",
                // "UNIDAD VILLETA"
            ];

            var TiposCultivo = [
                // "MONOCULTIVO", "ASOCIADO"
                ];
                // FIN ANGELICA

                //INICIO DEV ANGÉLICA
            var Departamentos = [];

            Ctrl.Salir = $mdDialog.cancel;


            Ctrl.FincasCRUD = $injector.get("CRUD").config({
                base_url: "/api/fincas/fincas",
                limit: 1000,
                add_append: "refresh",
                order_by: ["-created_at"],
                query_with: ["zona"]
            });

            Ctrl.getFinca = () => {
                // Ctrl.FincasCRUD.setScope("id", Rs.Usuario.finca_id); //Me trae las fincas del usuario
                Ctrl.FincasCRUD.get().then(() => {
                    Ctrl.Finca = Ctrl.FincasCRUD.rows[0];
                    //Ctrl.editarFinca(Ctrl.FincasCRUD.rows[0]);
                });
            };

            Ctrl.getFinca();
            //Obtener el elemento de la lista
        Ctrl.getDepartamentos = () => {
			$http.post ('api/lista/obtener', { lista: 'Departamentos' }).then((r)=>{
                Departamentos = r.data;
			});
		}

		Ctrl.getDepartamentos();


        //Obtener el elemento de la lista
        Ctrl.getTiposSuelo = () => {
			$http.post ('api/lista/obtener', { lista: 'TiposSuelo' }).then((r)=>{
                TiposSuelo = r.data;
                console.log(TiposSuelo);
			});
		}

		Ctrl.getTiposSuelo();

        //Obtener el elemento de la lista
        Ctrl.getTiposCultivo = () => {
			$http.post ('api/lista/obtener', { lista: 'TiposCultivo' }).then((r)=>{
                TiposCultivo = r.data;
                console.log(TiposCultivo);
			});
		}

		Ctrl.getTiposCultivo();
        //FIN DEV ANGELICA
        //INICIO DEV ANGPELICA
        loadDepartamentos = (col_departamento) => {

            col_departamento.Options.options = Departamentos;

            /*departamentos.forEach(departamento => {
                let codigo = departamento.codigo;
                let descripcion = departamento.descripcion;
                col_departamento.Options.options = {...col_departamento.Options.options, 
                    [codigo]: descripcion // si quiero que en la base de datos se vea por codigos en departamento y municipio
                    //[descripcion]: descripcion // si quiero que en la base de datos se vea por nombres(descripcion) en departamento y municipio
                };
            });//Llena el select de departamentos
            */
        }

        loadMunicipios = (valorDepartamento, col_municipio) => {
            col_municipio.Options.options = {}; //limpia el select de municipios
            console.log(valorDepartamento);

            $http.post ('api/lista/obtener', { lista: 'Municipios', Op1: valorDepartamento }).then((r)=>{
                col_municipio.Options.options = r.data;
			});

        }

        inicializarListas = () => {
            let col_TiposSuelo = Ctrl.FincasCRUD.columns.find(c => c.Field == 'tipo_suelo');
            col_TiposSuelo.Options.options = TiposSuelo;

            let col_TiposCultivo = Ctrl.FincasCRUD.columns.find(c => c.Field == 'tipo_cultivo');
            col_TiposCultivo.Options.options = TiposCultivo;

            let col_departamento = Ctrl.FincasCRUD.columns.find(c => c.Field == 'departamento_id');
            loadDepartamentos(col_departamento);
    
            col_departamento.Options.onChangeFn = (valorDepartamento) => {
                let col_municipio = Ctrl.FincasCRUD.columns.find(c => c.Field == 'municipio_id');
                loadMunicipios(valorDepartamento, col_municipio);
            }                        

        }
        //FIN DEV ANGÉLICA

            //INICIO DEV ANGÉLICA
        Ctrl.nuevaFinca = () => { //Esta es una función que me crea automaticamente la modal y lleva la informacion a la BD desde la modal de CRUD
            inicializarListas();
            Ctrl.FincasCRUD.dialog({
                Flex: 50,
                Title: 'Crear Finca',
                Confirm: { Text: 'Crear Finca' },
            }).then(r => {
                if (!r) return;
                Ctrl.FincasCRUD.add(r);
            });
        //FIN DEV ANGÉLICA
                // Rs.BasicDialog({
                //     Flex: 30,
                //     Title: "Crear Finca",
                //     Fields: [
                //         {
                //             Nombre: "Usuario",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Nombre",
                //             Value: "",
                //             Type: "string",
                //             List: TiposSuelo,
                //             Required: true
                //         },
                //         {
                //             Nombre: "Dirección",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Departamento",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Municipio",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Área total",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Total de lotes",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Tipo de cultivo",
                //             Value: TiposCultivo[0],
                //             Type: "simplelist",
                //             List: TiposCultivo,
                //             Required: true
                //         },

                //         {
                //             Nombre: "Tipo de Suelo",
                //             Value: TiposSuelo[0],
                //             Type: "simplelist",
                //             List: TiposSuelo,
                //             Required: true
                //         },
                //         {
                //             Nombre: "Zona",
                //             Value: "",
                //             TType: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Latitud",
                //             Value: "",
                //             TType: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Longitud",
                //             Value: "",
                //             TType: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Hectareas",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Sitios",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Temperatura (C°):",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Humedad Relativa (%):",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Precipitacion (Mm):",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Altimetria Minima (Mt):",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Altimetria Maxima (Mt):",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         },
                //         {
                //             Nombre: "Brillo Solar (H):",
                //             Value: "",
                //             Type: "string",
                //             Required: true
                //         }
                //     ],

                //     Confirm: { Text: "Crear Finca" }
                // }).then(r => {
                //     if (!r) return;
                //     var nuevaFinca = {
                //         usuario_id: r.Fields[0].Value,
                //         nombre: r.Fields[1].Value,
                //         direccion: r.Fields[2].Value,
                //         departamento_id: r.Fields[3].Value,
                //         municipio_id: r.Fields[4].Value,
                //         area_total: r.Fields[5].Value,
                //         total_lotes: r.Fields[6].Value,
                //         tipo_cultivo: r.Fields[7].Value,
                //         tipo_suelo: r.Fields[8].Value,
                //         zona_id: r.Fields[9].Value,
                //         latitud: r.Fields[10].Value,
                //         longitud: r.Fields[11].Value,
                //         hectareas: r.Fields[12].Value,
                //         sitios: r.Fields[13].Value,
                //         temperatura: r.Fields[14].Value,
                //         humedad_relativa: r.Fields[15].Value,
                //         precipitacion: r.Fields[16].Value,
                //         altimetria_min: r.Fields[17].Value,
                //         altimetria_max: r.Fields[18].Value,
                //         brillo_solar: r.Fields[19].Value
                //     };
                //     Ctrl.FincasCRUD.add(nuevaFinca);
                // });
            // };
            //INICIO DEV ANGÉLICA
        Ctrl.editarFinca = (O) => { //La variable O tiene la información de la Finca actual que se está editando
            console.log(O);
            inicializarListas(); 
			Ctrl.FincasCRUD.dialog(O, {
				title: 'Editar Finca' + O.nombre
			}).then(r => {
				if(r == 'DELETE') return Ctrl.FincasCRUD.delete(O);
				Ctrl.FincasCRUD.update(r).then(() => {
					Rs.showToast('Finca actualizada');
				});
			});
            let col_municipio = Ctrl.FincasCRUD.columns.find(c => c.Field == 'municipio_id');
            loadMunicipios(O.departamento_id, col_municipio); //obtengo la lista de los municipios asociados al departamento de la finca (la variable O)
		}//FIN DEV ANGÉLICA

            // Ctrl.editarFinca = F => {
            //     Rs.BasicDialog({
            //         Flex: 30,
            //         Title: "Editar Finca",
            //         Fields: [
            //             {
            //                 Nombre: "Usuario",
            //                 Value: F.usuario_id,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Nombre",
            //                 Value: F.nombre,
            //                 Type: "string",
            //                 List: TiposSuelo,
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Dirección",
            //                 Value: F.direccion,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Departamento",
            //                 Value: F.departamento_id,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Municipio",
            //                 Value: F.municipio_id,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Área total",
            //                 Value: F.area_total,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Total de lotes",
            //                 Value: F.total_lotes,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Tipo de cultivo",
            //                 Value: TiposCultivo[0],
            //                 Type: "simplelist",
            //                 List: TiposCultivo,
            //                 Required: true
            //             },

            //             {
            //                 Nombre: "Tipo de Suelo",
            //                 Value: TiposSuelo[0],
            //                 Type: "simplelist",
            //                 List: TiposSuelo,
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Zona",
            //                 Value: F.zona_id,
            //                 TType: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Latitud",
            //                 Value: F.latitud,
            //                 TType: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Longitud",
            //                 Value: F.longitud,
            //                 TType: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Hectareas",
            //                 Value: F.hectareas,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Sitios",
            //                 Value: F.sitios,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Temperatura (C°):",
            //                 Value: F.temperatura,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Humedad Relativa (%):",
            //                 Value: F.humedad_relativa,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Precipitacion Mm:",
            //                 Value: F.precipitacion,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Altimetria Minima (Mt):",
            //                 Value: F.altimetria_min,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Altimetria Maxima (Mt):",
            //                 Value: F.altimetria_max,
            //                 Type: "string",
            //                 Required: true
            //             },
            //             {
            //                 Nombre: "Brillo Solar (H):",
            //                 Value: F.brillo_solar,
            //                 Type: "string",
            //                 Required: true
            //             }
            //         ],

            //         Confirm: { Text: "Guardar" }
            //     }).then(r => {
            //         if (!r) return;
            //         var FincaEditada = {
            //             id: F.id,
            //             usuario_id: r.Fields[0].Value,
            //             nombre: r.Fields[1].Value,
            //             direccion: r.Fields[2].Value,
            //             departamento_id: r.Fields[3].Value,
            //             municipio_id: r.Fields[4].Value,
            //             area_total: r.Fields[5].Value,
            //             total_lotes: r.Fields[6].Value,
            //             tipo_cultivo: r.Fields[7].Value,
            //             tipo_suelo: r.Fields[8].Value,
            //             zona_id: r.Fields[9].Value,
            //             latitud: r.Fields[10].Value,
            //             longitud: r.Fields[11].Value,
            //             hectareas: r.Fields[12].Value,
            //             sitios: r.Fields[13].Value,
            //             temperatura: r.Fields[14].Value,
            //             humedad_relativa: r.Fields[15].Value,
            //             precipitacion: r.Fields[16].Value,
            //             altimetria_min: r.Fields[17].Value,
            //             altimetria_max: r.Fields[18].Value,
            //             brillo_solar: r.Fields[19].Value
            //         };

            //         Ctrl.FincasCRUD.update(FincaEditada).then(() => {
            //             Rs.showToast("Finca actualizada");
            //         });
            //     });
            };

            Ctrl.eliminarFinca = F => {
                Rs.confirmDelete({
                    Title: "¿Eliminar Finca #" + F.id + "?"
                }).then(d => {
                    if (!d) return;
                    Ctrl.FincasCRUD.delete(F);
                });
            };

            Ctrl.abrirFinca = F => {
                $mdDialog.show({
                    templateUrl: "Frag/MiFinca.FincaDiag",
                    controller: "FincaDiagCtrl",
                    locals: { Finca: F },
                    fullscreen: false
                });
            };

            //Prueba de Lista
            $http
                .post("api/main/obtener-lista", {
                    Lista: "Departamentos",
                    op1: "COL"
                })
                .then(r => {
                    console.log(r.data);
                });

            Ctrl.editarLote = L => {
                Ctrl.LotesCRUD.dialog(L, {
                    title: "Editar Lote" + L.id
                }).then(r => {
                    if (r == "DELETE") return Ctrl.LotesCRUD.delete(L);
                    Ctrl.LotesCRUD.update(r).then(() => {
                        Rs.showToast("Lote actualizado");
                    });
                });
            };

            Ctrl.eliminarLote = L => {
                Rs.confirmDelete({
                    Title: "¿Eliminar Lote #" + L.id + "?"
                }).then(d => {
                    if (!d) return;
                    Ctrl.LotesCRUD.delete(L);
                });
            };
        }
    ])
    .directive("mapa", function() {
        return {
            restrict: "A",
            link: function($scope, element, attrs) {
                var map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: 4.852147911841803, lng: -75.5747982566813 },
                    mapTypeId: "satellite",
                    zoom: 18,
                    disableDefaultUI: false
                });

                $scope.map = map;

                const iconBase = "http://efiagro.local//imgs/";
                const icons = {
                    finca: {
                        icon: iconBase + "finca-icono.png"
                    }
                };

                var marker = new google.maps.Marker({
                    position: {
                        lat: 4.852147911841803,
                        lng: -75.5747982566813
                    },
                    icon: icons["finca"].icon,
                    map: map
                });

                // Define the LatLng coordinates for the polygon.
                const GCCoords = [
                    { lat: 4.850726639851928, lng: -75.575134148821235 },
                    { lat: 4.850728400051594, lng: -75.575136328116059 },
                    { lat: 4.850811045616865, lng: -75.575285442173481 },
                    { lat: 4.850812889635563, lng: -75.575296422466636 },
                    { lat: 4.850881118327379, lng: -75.5754105001688 },
                    { lat: 4.850978180766106, lng: -75.575610073283315 },
                    { lat: 4.850978180766106, lng: -75.575612252578139 },
                    { lat: 4.851046409457922, lng: -75.575732868164778 },
                    { lat: 4.85116945579648, lng: -75.575770167633891 },
                    { lat: 4.851228799670935, lng: -75.575770167633891 },
                    { lat: 4.851261069998145, lng: -75.575794307515025 },
                    { lat: 4.851345559582114, lng: -75.575781147927046 },
                    { lat: 4.851345559582114, lng: -75.57578332722187 },
                    { lat: 4.851390486583114, lng: -75.575798666104674 },
                    { lat: 4.851440778002143, lng: -75.575864464044571 },
                    { lat: 4.851500038057566, lng: -75.575844682753086 },
                    { lat: 4.851552173495293, lng: -75.575772346928716 },
                    { lat: 4.851552173495293, lng: -75.575770167633891 },
                    { lat: 4.851584527641535, lng: -75.575730688869953 },
                    { lat: 4.851586287841201, lng: -75.575730688869953 },
                    { lat: 4.851634819060564, lng: -75.575737226754427 },
                    { lat: 4.851728277280927, lng: -75.575844682753086 },
                    { lat: 4.851789297536016, lng: -75.575824985280633 },
                    { lat: 4.851789297536016, lng: -75.575822805985808 },
                    { lat: 4.851827016100287, lng: -75.575792044401169 },
                    { lat: 4.851858532056212, lng: -75.575729599222541 },
                    { lat: 4.851858532056212, lng: -75.575720882043242 },
                    { lat: 4.85189801082015, lng: -75.57567042298615 },
                    { lat: 4.851973447948694, lng: -75.575600266456604 },
                    { lat: 4.8520543333143, lng: -75.575560787692666 },
                    { lat: 4.852109989151359, lng: -75.575538827106357 },
                    { lat: 4.852140583097935, lng: -75.575519045814872 },
                    { lat: 4.852224988862872, lng: -75.575424749404192 },
                    { lat: 4.852307634428144, lng: -75.575347971171141 },
                    { lat: 4.852307634428144, lng: -75.575345791876316 },
                    { lat: 4.852334624156356, lng: -75.575321651995182 },
                    { lat: 4.852334624156356, lng: -75.575242694467306 },
                    { lat: 4.852357925847173, lng: -75.57518133893609 },
                    { lat: 4.852453144267201, lng: -75.575168179348111 },
                    { lat: 4.85253126360476, lng: -75.575197767466307 },
                    { lat: 4.852599492296577, lng: -75.575215285643935 },
                    { lat: 4.852730669081211, lng: -75.575138507410884 },
                    { lat: 4.852797137573361, lng: -75.575048653408885 },
                    { lat: 4.852834856137633, lng: -75.574952093884349 },
                    { lat: 4.852834856137633, lng: -75.574949914589524 },
                    { lat: 4.852861845865846, lng: -75.574901634827256 },
                    { lat: 4.852901324629784, lng: -75.57485343888402 },
                    { lat: 4.852948011830449, lng: -75.574816139414907 },
                    { lat: 4.853025292977691, lng: -75.574800800532103 },
                    { lat: 4.853023532778025, lng: -75.574800800532103 },
                    { lat: 4.85317088663578, lng: -75.5747733078897 },
                    { lat: 4.85317088663578, lng: -75.574771128594875 },
                    { lat: 4.853284126147628, lng: -75.574760148301721 },
                    { lat: 4.853343386203051, lng: -75.574720669537783 },
                    { lat: 4.853370292112231, lng: -75.574714047834277 },
                    { lat: 4.853402646258473, lng: -75.574705330654979 },
                    { lat: 4.853363167494535, lng: -75.574657050892711 },
                    { lat: 4.853361323475838, lng: -75.574654871597886 },
                    { lat: 4.853298459202051, lng: -75.574582451954484 },
                    { lat: 4.853258896619082, lng: -75.574492514133453 },
                    { lat: 4.853226626291871, lng: -75.574389500543475 },
                    { lat: 4.853214053437114, lng: -75.574312722310424 },
                    { lat: 4.853212209418416, lng: -75.574312722310424 },
                    { lat: 4.853185303509235, lng: -75.574152627959847 },
                    { lat: 4.853199636563659, lng: -75.574034191668034 },
                    { lat: 4.853208689019084, lng: -75.573920197784901 },
                    { lat: 4.853208689019084, lng: -75.573762282729149 },
                    { lat: 4.853201564401388, lng: -75.573635045439005 },
                    { lat: 4.853215897455812, lng: -75.573582407087088 },
                    { lat: 4.852939210832119, lng: -75.57362406514585 },
                    { lat: 4.852757742628455, lng: -75.573689863085747 },
                    { lat: 4.852755982428789, lng: -75.573689863085747 },
                    { lat: 4.852480133995414, lng: -75.573856579139829 },
                    { lat: 4.852042766287923, lng: -75.574178947135806 },
                    { lat: 4.851759793236852, lng: -75.574416909366846 },
                    { lat: 4.851539684459567, lng: -75.574608854949474 },
                    { lat: 4.851218992844224, lng: -75.57467021048069 },
                    { lat: 4.851070884615183, lng: -75.57471077889204 },
                    { lat: 4.851068202406168, lng: -75.57471077889204 },
                    { lat: 4.850981952622533, lng: -75.574770038947463 },
                    { lat: 4.850979270413518, lng: -75.5747733078897 },
                    { lat: 4.850911879912019, lng: -75.574868693947792 },
                    { lat: 4.850728651508689, lng: -75.575131885707378 }
                ];
                // Construct the polygon.
                const GClocation = new google.maps.Polygon({
                    paths: GCCoords,
                    strokeColor: "#a3e5b2",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#a3e5b2",
                    fillOpacity: 0.45
                });
                GClocation.setMap(map);
            }
        };
    });
