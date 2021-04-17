angular.module("CultivosCtrl", []).controller("CultivosCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("CultivosCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;
        
        Ctrl.Salir = $mdDialog.cancel;

           Ctrl.CultivosCRUD = $injector.get("CRUD").config({
            base_url: "/api/cultivos/cultivos",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"],
            query_with:['zona']
        });

        Ctrl.getCultivos = () => {
            Ctrl.CultivosCRUD.get().then(() => {
                // Ctrl.Cultivos = Ctrl.CultivosCRUD.rows[0];
            });
        };

        Ctrl.getCultivos();

        Ctrl.nuevoCultivo = () => {
            Ctrl.CultivosCRUD.dialog({
                Flex: 10,
                Title: "Crear Cultivo",

                Confirm: { Text: "Crear Cultivo" }
            }).then(r => {
                if (!r) return;
                Ctrl.CultivosCRUD.add(r);
                Rs.showToast('Cultivo Creado');
            });
        };
        Ctrl.editarCultivo = C => {
            Ctrl.CultivosCRUD.dialog(C, {
                title: "Editar Cultivo" + C.id
            }).then(r => {
                if (r == "DELETE") return Ctrl.CultivosCRUD.delete(C);
                Ctrl.CultivosCRUD.update(r).then(() => {
                    Rs.showToast("Cultivo actualizado");
                });
            });
        };

        Ctrl.eliminarCultivo = C => {
            Rs.confirmDelete({
                Title: "¿Eliminar Cultivo #" + C.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.CultivosCRUD.delete(C);
            });
        };

        Ctrl.obtener_zonas = ()=>{
            return $http.post('api/zonas/obtener', {}).then(r => {
                Ctrl.zonas = r.data;
                Ctrl.zona_select = Ctrl.zonas[0].id;
                
            });
        }

        Promise.all([
            Ctrl.obtener_zonas()
        ]).then(() => {
            Ctrl.getCultivos();
        });
	
    }
]);
