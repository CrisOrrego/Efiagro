angular.module("LotesCtrl", []).controller("LotesCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("LotesCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.Salir = $mdDialog.cancel;

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
                title: "Editar Lote" + L.nombre
            }).then(r => {
                if (r == "DELETE") return Ctrl.LotesCRUD.delete(L);
                Ctrl.LotesCRUD.update(r).then(() => {
                    Rs.showToast("Lote actualizada");
                });
            });
        };

        Ctrl.eliminarLote = (L) => {
            Rs.confirmDelete({
                Title: "¿Eliminar Lote #" +L.id+ "?",
            }).then(d => {
                if (!d) return;
                Ctrl.LotesCRUD.delete(L);
            });
        };

       Ctrl.abrirLote = (L) => {
            $mdDialog.show({
                templateUrl: "Frag/MiLote.LoteDiag",
                controller: "LoteDiagCtrl",
                locals: { Lote: L },
                fullscreen: false,
            });
        };

       }
]);
