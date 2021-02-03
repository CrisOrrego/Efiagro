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

        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.FincasCRUD = $injector.get("CRUD").config({
            base_url: "/api/fincas/fincas",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getFincas = () => {
            Ctrl.FincasCRUD.get().then(() => {
                //Ctrl.editarFinca(Ctrl.FincasCRUD.rows[0]);
            });
        };

        Ctrl.getFincas();

        Ctrl.nuevaFinca = () => {
            Ctrl.FincasCRUD.dialog({
                Flex: 10,
                Title: "Crear Finca",

                Confirm: { Text: "Crear Finca" }
            }).then(r => {
                if (!r) return;
                Ctrl.FincasCRUD.add(r);
            });
        };

        Ctrl.editarFinca = F => {
            Ctrl.FincasCRUD.dialog(F, {
                title: "Editar Finca" + F.nombre
            }).then(r => {
                if (r == "DELETE") return Ctrl.FincasCRUD.delete(F);
                Ctrl.FincasCRUD.update(r).then(() => {
                    Rs.showToast("Finca actualizada");
                });
            });
        };

        Ctrl.eliminarFinca = (F) => {
            Rs.confirmDelete({
                Title: "¿Eliminar Finca #" +F.id+ "?",
            }).then(d => {
                if (!d) return;
                Ctrl.FincasCRUD.delete(F);
            });
        };

        // $http.post("api/fincas/obtener", {}).then(r => {
        //     Ctrl.Fincas = r.data;
        //     Ctrl.abrirFinca(Ctrl.Fincas[3]); //FIX
        // });

        Ctrl.abrirFinca = (F) => {
            $mdDialog.show({
                templateUrl: "Frag/MiFinca.FincaDiag",
                controller: "FincaDiagCtrl",
                locals: { Finca: F },
                fullscreen: false,
            });
        };

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

        Ctrl.eliminarLote = (L) => {
            Rs.confirmDelete({
                Title: "¿Eliminar Lote #" +L.id+ "?",
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

       }
]);
