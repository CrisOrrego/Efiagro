angular.module("FincaEventosCtrl", []).controller("FincaEventosCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {

        var Ctrl = $scope;
        var Rs = $rootScope;
     
        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.value = 0;

        // FINCA EVENTOS
        Ctrl.FincaEventosCRUD = $injector.get("CRUD").config({
            base_url: "/api/fincaeventos/fincaeventos",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"],
            query_with:['finca', 'evento']
        });

        Ctrl.getFincaEventos = () => {
            Ctrl.FincaEventosCRUD.get().then(() => {
                Ctrl.FincaEventos = Ctrl.FincaEventosCRUD.rows[0];
                //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
            });
        };

        Ctrl.getFincaEventos();

        Ctrl.nuevoFincaEvento = () => {
            Ctrl.FincaEventosCRUD.dialog({
                Flex: 10,
                Title: "Crear Evento",

                Confirm: { Text: "Crear Evento" }
            }).then(r => {
                if (!r) return;
                Ctrl.FincaEventosCRUD.add(r);
                Rs.showToast('Evento Reportado');
            });
        };
        Ctrl.editarFincaEvento = FE => {
            Ctrl.FincaEventosCRUD.dialog(FE, {
                title: "Editar Evento Reportado" + FE.id
            }).then(r => {
                if (r == "DELETE") return Ctrl.FincaEventosCRUD.delete(FE);
                Ctrl.FincaEventosCRUD.update(r).then(() => {
                    Rs.showToast("Evento Atualizado");
                });
            });
        };
        Ctrl.eliminarFincaEvento = FE => {
            Rs.confirmDelete({
                Title: "¿Eliminar Evento Reportado #" + FE.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.FincaEventosCRUD.delete(FE);
            });
        };
        Ctrl.cargarImagen = async(FE) => {
            var Imagen = await $mdDialog.show({
                templateUrl: 'templates/dialogs/image-editor.html',
                controller: 'ImageEditor_DialogCtrl',
                multiple: true,
                locals: {
                    Config: {
                        Theme: 'default',
                        CanvasWidth: 200,
                        CanvasHeight: 200,
                        CropWidth: 200,
                        CropHeight: 200,
                        MinWidth: 50,
                        MinHeight: 50,
                        KeepAspect: true,
                        Preview: false,
                        Daten: {
                            Path: 'files/eventos_media/' + FE.id + '.jpg'
                        }
                    }
                }
            });
        };


    }
]);
