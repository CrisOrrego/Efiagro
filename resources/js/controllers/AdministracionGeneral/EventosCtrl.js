angular.module("EventosCtrl", []).controller("EventosCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {

        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.zona_select = null;
        
        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.value = 0;


           Ctrl.EventosCRUD = $injector.get("CRUD").config({
            base_url: "/api/eventos/eventos",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"],
            query_with:['zona']
        });

        Ctrl.getEventos = () => {
            Ctrl.EventosCRUD.get().then(() => {
                Ctrl.Evento = Ctrl.EventosCRUD.rows[0];
                //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
            });
        };

        Ctrl.getEventos();

        Ctrl.nuevoEvento = () => {
            Ctrl.EventosCRUD.dialog({
                Flex: 10,
                Title: "Crear Evento",

                Confirm: { Text: "Crear Evento" }
            }).then(r => {
                if (!r) return;
                Ctrl.EventosCRUD.add(r);
                Rs.showToast('Evento Creado');
            });
        };
        Ctrl.editarEvento = E => {
            Ctrl.EventosCRUD.dialog(C, {
                title: "Editar Evento" + E.id
            }).then(r => {
                if (r == "DELETE") return Ctrl.EventosCRUD.delete(E);
                Ctrl.EventosCRUD.update(r).then(() => {
                    Rs.showToast("Evento actualizado");
                });
            });
        };
        Ctrl.eliminareVENTO = E => {
            Rs.confirmDelete({
                Title: "¿Eliminar Lote #" + E.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.LotesCRUD.delete(E);
            });
        };


    }
]);
