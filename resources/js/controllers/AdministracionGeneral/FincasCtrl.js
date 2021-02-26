angular.module("FincasCtrl", []).controller("FincasCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("FincasCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        var TiposSuelo = [
             "UNIDAD AMAGÁ",
             "UNIDAD ARMENIA",
             "UNIDAD CASCARERO",
             "UNIDAD CARTAGENITA",
             "UNIDAD CINCHO",
             "UNIDAD CHANCHÓN",
             "UNIDAD CHINCHINÁ",
             "UNIDAD CHUSCAL",
             "UNIDAD DOÑA JUANA",
             "UNIDAD DOSCIENTOS",
             "UNIDAD EL PALMAR",
             "UNIDAD FONDESA",
             "UNIDAD FRESNO",
             "UNIDAD GUADALUPE",
             "UNIDAD LA MONTAÑA",
             "UNIDAD LIBANO",
             "UNIDAD LLANO DE PALMAS",
             "UNIDAD MALABAR",
             "UNIDAD MONTENEGRO",
             "UNIDAD NORTE",
             "UNIDAD PERIJÁ",
             "UNIDAD PAUJIL",
             "UNIDAD PIENDAMÓ",
             "UNIDAD QUINDÍO",
             "UNIDAD ROPERO",
             "UNIDAD SALGAR",
             "UNIDAD SAN SIMÓN",
             "UNIDAD SUÁREZ",
             "UNIDAD SUROESTE",
             "UNIDAD TABLAZO",
             "UNIDAD TIMBÍO",
             "UNIDAD VENECIA",
             "UNIDAD VILLETA",             
        ];

        var TiposCultivo  = [
            "MONOCULTIVO",
            "ASOCIADO",
        ];

        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.FincasCRUD = $injector.get("CRUD").config({
            base_url: "/api/fincas/fincas",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getFinca = () => {
            Ctrl.FincasCRUD.setScope("id", Rs.Usuario.finca_id); //Me trae las fincas del usuario
            Ctrl.FincasCRUD.get().then(() => {
                Ctrl.Finca = Ctrl.FincasCRUD.rows[0];
                //Ctrl.editarFinca(Ctrl.FincasCRUD.rows[0]);
            });
        };

        Ctrl.getFinca();

        Ctrl.nuevaFinca = () => {
            Rs.BasicDialog({
                Flex: 30,
                Title: "Crear Finca",
                Fields: [
                    {
                        Nombre: "Usuario",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Nombre",
                        Value: "",
                        Type: "string",
                        List: TiposSuelo,
                        Required: true
                    },
                    {
                        Nombre: "Dirección",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Departamento",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Municipio",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Área total",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Total de lotes",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Tipo de cultivo",
                        Value: TiposCultivo[0],
                        Type: "simplelist",
                        List: TiposCultivo,
                        Required: true
                    },
                    
                    {
                        Nombre: "Tipo de Suelo",
                        Value: TiposSuelo[0],
                        Type: "simplelist",
                        List: TiposSuelo,
                        Required: true
                    },
                    {
                        Nombre: "Zona",
                        Value: "",
                        TType: "string",
                        Required: true
                    },
                    {
                        Nombre: "Latitud",
                        Value: "",
                        TType: "string",
                        Required: true
                    },
                    {
                        Nombre: "Longitud",
                        Value: "",
                        TType: "string",
                        Required: true
                    },
                    {
                        Nombre: "Hectareas",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Sitios",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Temperatura (C°):",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Humedad Relativa (%):",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Precipitacion Mm:",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Altimetria Minima (Mt):",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Altimetria Maxima (Mt):",
                        Value: "",
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Brillo Solar (H):",
                        Value: "",
                        Type: "string",
                        Required: true
                    }
                ],

                Confirm: { Text: "Crear Finca" }
            }).then(r => {
                if (!r) return;
                var nuevaFinca = {
                    usuario_id : r.Fields[0].Value,
                    nombre: r.Fields[1].Value,
                    direccion: r.Fields[2].Value,
                    departamento_id: r.Fields[3].Value,
                    municipio_id: r.Fields[4].Value,
                    area_total: r.Fields[5].Value,
                    total_lotes: r.Fields[6].Value,
                    tipo_cultivo: r.Fields[7].Value,
                    tipo_suelo: r.Fields[8].Value,
                    zona_id : r.Fields[9].Value,
                    latitud: r.Fields[10].Value,
                    longitud: r.Fields[11].Value,
                    hectareas: r.Fields[12].Value,
                    sitios: r.Fields[13].Value,
                    temperatura: r.Fields[14].Value,
                    humedad_relativa: r.Fields[15].Value,
                    precipitacion: r.Fields[16].Value,
                    altimetria_min: r.Fields[17].Value,
                    altimetria_max: r.Fields[18].Value,
                    brillo_solar: r.Fields[19].Value,

                };
                Ctrl.FincasCRUD.add(nuevaFinca);
            });
        };

        Ctrl.editarFinca = F => {
            Rs.BasicDialog({
                Flex: 30,
                Title: "Crear Finca",
                Fields: [
                    {
                        Nombre: "Usuario",
                        Value: F.usuario_id,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Nombre",
                        Value: F.nombre,
                        Type: "string",
                        List: TiposSuelo,
                        Required: true
                    },
                    {
                        Nombre: "Dirección",
                        Value: F.direccion,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Departamento",
                        Value: F.departamento_id,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Municipio",
                        Value: F.municipio_id,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Área total",
                        Value: F.area_total,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Total de lotes",
                        Value: F.total_lotes,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Tipo de cultivo",
                        Value: TiposCultivo[0],
                        Type: "simplelist",
                        List: TiposCultivo,
                        Required: true
                    },
                    
                    {
                        Nombre: "Tipo de Suelo",
                        Value: TiposSuelo[0],
                        Type: "simplelist",
                        List: TiposSuelo,
                        Required: true
                    },
                    {
                        Nombre: "Zona",
                        Value: F.zona_id,
                        TType: "string",
                        Required: true
                    },
                    {
                        Nombre: "Latitud",
                        Value: F.latitud,
                        TType: "string",
                        Required: true
                    },
                    {
                        Nombre: "Longitud",
                        Value: F.longitud,
                        TType: "string",
                        Required: true
                    },
                    {
                        Nombre: "Hectareas",
                        Value: F.hectareas,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Sitios",
                        Value: F.sitios,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Temperatura (C°):",
                        Value: F.temperatura,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Humedad Relativa (%):",
                        Value: F.humedad_relativa,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Precipitacion Mm:",
                        Value: F.precipitacion,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Altimetria Minima (Mt):",
                        Value: F.altimetria_min,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Altimetria Maxima (Mt):",
                        Value: F.altimetria_max,
                        Type: "string",
                        Required: true
                    },
                    {
                        Nombre: "Brillo Solar (H):",
                        Value: F.brillo_solar,
                        Type: "string",
                        Required: true
                    }
                ],

                Confirm: { Text: "Crear Finca" }
            }).then(r => {
                if (!r) return;
                var FincaEditada = {
                    id: F.id,
                    usuario_id : r.Fields[0].Value,
                    nombre: r.Fields[1].Value,
                    direccion: r.Fields[2].Value,
                    departamento_id: r.Fields[3].Value,
                    municipio_id: r.Fields[4].Value,
                    area_total: r.Fields[5].Value,
                    total_lotes: r.Fields[6].Value,
                    tipo_cultivo: r.Fields[7].Value,
                    tipo_suelo: r.Fields[8].Value,
                    zona_id : r.Fields[9].Value,
                    latitud: r.Fields[10].Value,
                    longitud: r.Fields[11].Value,
                    hectareas: r.Fields[12].Value,
                    sitios: r.Fields[13].Value,
                    temperatura: r.Fields[14].Value,
                    humedad_relativa: r.Fields[15].Value,
                    precipitacion: r.Fields[16].Value,
                    altimetria_min: r.Fields[17].Value,
                    altimetria_max: r.Fields[18].Value,
                    brillo_solar: r.Fields[19].Value,

                };

            // Ctrl.FincasCRUD.dialog(F, {
            //     title: "Editar Finca" + F.nombre
            // }).then(r => {
            //     if (r == "DELETE") return Ctrl.FincasCRUD.delete(F);
                Ctrl.FincasCRUD.update(FincaEditada).then(() => {
                    Rs.showToast("Finca actualizada");
                });
            });
        };

        Ctrl.eliminarFinca = F => {
            Rs.confirmDelete({
                Title: "¿Eliminar Finca #" + F.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.FincasCRUD.delete(F);
            });
        };

        // $http.post("api/fincas/obtener", {}).then(r => {
        //     Ctrl.Fincas = r.data;
        //     Ctrl.abrirFinca(Ctrl.Fincas[3]); //FIX
        // });

        Ctrl.abrirFinca = F => {
            $mdDialog.show({
                templateUrl: "Frag/MiFinca.FincaDiag",
                controller: "FincaDiagCtrl",
                locals: { Finca: F },
                fullscreen: false
            });
        };

        Ctrl.abrirOrganizacion = O => {
            $mdDialog.show({
                templateUrl: "Frag/GestionOrganizacion.Organizacion",
                controller: "FincasCtrl",
                locals: { Finca: O },
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

        // LOTES
        Ctrl.LotesCRUD = $injector.get("CRUD").config({
            base_url: "/api/lotes/lotes",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getLotes = () => {
            Ctrl.LotesCRUD.get().then(() => {
                //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
            });
        };

        Ctrl.getLotes();

        // //Prueba de Mapa
        // $http.post('map.html').then(r => {
        //     Ctrl.mapa = r.data;
        // });

        Ctrl.nuevaLote = () => {
            Ctrl.LotesCRUD.dialog({
                Flex: 10,
                Title: "Crear Lote",

                Confirm: { Text: "Crear Lote" }
            }).then(r => {
                if (!r) return;
                Ctrl.LotesCRUD.add(r);
            });
        };

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

        //    Ctrl.abrirLote = (L) => {
        //         $mdDialog.show({
        //             templateUrl: "Frag/MiFinca.FincaDiag",
        //             controller: "FincaDiagCtrl",
        //             locals: { Lote: L },
        //             fullscreen: false,
        //         });
        //     };

        // TAREAS

        Ctrl.TareasCRUD = $injector.get("CRUD").config({
            base_url: "/api/fincas/fincas",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getTareas = () => {
            Ctrl.TareasCRUD.get().then(() => {
                //Ctrl.editarTarea(Ctrl.TareasCRUD.rows[0]);
            });
        };

        Ctrl.getTareas();

        Ctrl.nuevaTarea = () => {
            Ctrl.TareasCRUD.dialog({
                Flex: 10,
                Title: "Crear Tarea",

                Confirm: { Text: "Crear Tarea" }
            }).then(r => {
                if (!r) return;
                Ctrl.TareasCRUD.add(r);
            });
        };

        Ctrl.editarTarea = T => {
            Ctrl.TareasCRUD.dialog(T, {
                title: "Editar Tarea" + T.id
            }).then(r => {
                if (r == "DELETE") return Ctrl.TareasCRUD.delete(T);
                Ctrl.TareasCRUD.update(r).then(() => {
                    Rs.showToast("Tarea actualizado");
                });
            });
        };

        Ctrl.eliminarTarea = T => {
            Rs.confirmDelete({
                Title: "¿Eliminar Tarea #" + T.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.TareasCRUD.delete(T);
            });
        };
        Ctrl.abrirTarea = T => {
            $mdDialog.show({
                templateUrl: "Frag/MiFinca.TareaDiag",
                controller: "TareaDiagCtrl",
                locals: { Tarea: T },
                fullscreen: false
            });
        };
    }
]);
