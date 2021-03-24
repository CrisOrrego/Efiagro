angular.module("CasosCtrl", []).controller("CasosCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("CasosCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        var TiposCasos = [
            "Consulta General",
            "Apoyo Técnico",
            "Contar Experiencia"
        ];

        Ctrl.CasosCRUD = $injector.get("CRUD").config({
            base_url: "/api/casos/casos",
            limit: 1000,
            add_append: "refresh",
            query_with: ["solicitante"],
            order_by: ["-created_at"]
        });
        //Inicio Dev Angélica
        //Filtra el tipo (sólo muestra los casos que deben aparecer en pantalla)-->'Consulta General', 'Apoyo Tecnico', 'Contar Experiencia'[ver archivo Caso.php]
        Ctrl.CasosCRUD.setScope("tipo");
        //Fin Dev Angélica

        Ctrl.UsuariosCRUD = $injector
            .get("CRUD")
            .config({ base_url: "/api/usuario/usuarios" });

        Ctrl.getCasos = () => {
            Promise.all([Ctrl.UsuariosCRUD.get()]).then(() => {
                Ctrl.CasosCRUD.get().then(() => {
                    //Ctrl.novedadesCaso(Ctrl.CasosCRUD.rows[1]);
                });
            });
        };

        Ctrl.getCasos();

        Ctrl.nuevoCaso = () => {
            Rs.BasicDialog({
                Flex: 30,
                Title: "Crear Nuevo Caso",
                Fields: [
                    {
                        Nombre: "Asociado",
                        Value: null,
                        Type: "list",
                        List: Ctrl.UsuariosCRUD.rows,
                        Required: false,
                        Item_Val: "id",
                        Item_Show: "nombre"
                    },
                    {
                        Nombre: "Tipo de Caso",
                        Value: TiposCasos[0],
                        Type: "simplelist",
                        List: TiposCasos,
                        Required: true
                    },
                    {
                        Nombre: "Describe el Caso",
                        Value: "",
                        Type: "textarea",
                        Required: true,
                        opts: { rows: 3 }
                    }
                ],
                Confirm: { Text: "Crear Caso" }
            }).then(r => {
                if (!r) return;

                var NuevoCaso = {
                    titulo: r.Fields[2].Value,
                    solicitante_id: r.Fields[0].Value,
                    tipo: r.Fields[1].Value,
                    asignados: "[]"
                };

                Ctrl.CasosCRUD.add(NuevoCaso);
            });
        };

        Ctrl.editarCaso = C => {
            Rs.BasicDialog({
                Flex: 30,
                Title: "Crear Nuevo Caso",
                Fields: [
                    {
                        Nombre: "Asociado",
                        Value: C.solicitante_id,
                        Type: "list",
                        List: Ctrl.UsuariosCRUD.rows,
                        Required: false,
                        Item_Val: "id",
                        Item_Show: "nombre"
                    },
                    {
                        Nombre: "Tipo de Caso",
                        Value: C.tipo,
                        Type: "simplelist",
                        List: TiposCasos,
                        Required: true
                    },
                    {
                        Nombre: "Describe el Caso",
                        Value: C.titulo,
                        Type: "textarea",
                        Required: true,
                        opts: { rows: 3 }
                    }
                ],
                Confirm: { Text: "Crear Caso" }
            }).then(r => {
                if (!r) return;

                var CasoEditado = {
                    id: C.id,
                    titulo: r.Fields[2].Value,
                    solicitante_id: r.Fields[0].Value,
                    tipo: r.Fields[1].Value,
                    asignados: "[]"
                };

                Ctrl.CasosCRUD.update(CasoEditado).then(() => {
                    Ctrl.CasosCRUD.get();
                    Rs.showToast("Caso actualizado");
                });
            });
        };

        Ctrl.eliminarCaso = C => {
            Rs.confirmDelete({
                Title: "¿Eliminar el caso #" + C.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.CasosCRUD.delete(C);
            });
        };

        // Inicia codigo Luigi
        Ctrl.novedadesCaso = C => {
            $mdDialog.show({
                templateUrl: "Frag/AdministracionGeneral.Casos_NovedadesDiag",
                controller: "Casos_NovedadesCtrl",
                locals: {
                    Caso: C
                }
            });
        };
        // Finaliza codigo Luigi
    }
]);
