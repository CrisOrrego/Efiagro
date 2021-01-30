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

       }
]);
