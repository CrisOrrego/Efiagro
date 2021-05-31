angular.module("LotesCtrl", []).controller("LotesCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        var Ctrl = $scope;
        var Rs = $rootScope;

       
        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.LotesCRUD = $injector.get("CRUD").config({
            base_url: "/api/lotes/lotes",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"],
            query_with:['finca', 'organizacion', 'linea_productiva', 'labor']
        });

        Ctrl.getLotes = () => {
            // Ctrl.LotesCRUD.setScope("id", Rs.Usuario.lote_id); //Me trae las fincas del usuario
            Ctrl.LotesCRUD.get().then(() => {
                Ctrl.Lote = Ctrl.LotesCRUD.rows[0];
                //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
            });
        };

        Ctrl.getLotes();

        Ctrl.nuevoLote = () => {
            Ctrl.LotesCRUD.dialog({
                Flex: 10,
                Title: "Crear Lote",

                Confirm: { Text: "Crear Lote" }
            }).then(r => {
                if (!r) return;
                Ctrl.LotesCRUD.add(r);
                Rs.showToast('Lote Creado');
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

        // LABORES
        Ctrl.abrirLabores = L => {
            $mdDialog.show({
                templateUrl: "Frag/MiFinca.LaboresDiag",
                controller: "LaboresDiagCtrl",
                locals: { Labor: L },
                fullscreen: false
            });
        };
        
    }
]);
