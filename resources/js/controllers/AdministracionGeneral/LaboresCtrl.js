angular.module("LaboresCtrl", []).controller("LaboresCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("LaboresCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.LaboresCRUD = $injector.get("CRUD").config({
            base_url: "/api/labores/labores",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getLabor = () => {
            // Ctrl.LaboresCRUD.setScope('id', Rs.Usuario.Labor_id);
            Ctrl.LaboresCRUD.get().then(() => {
                Ctrl.Labor = Ctrl.LaboresCRUD.rows[0];
                
            });
        };

       
        Ctrl.getLabor();

        Ctrl.nuevaLabor = () => {
            Ctrl.LaboresCRUD.dialog({
                Flex: 10,
                Title: "Crear Labor",
                Confirm: { Text: "Crear Labor" }
            }).then(r => {
                if (!r) return;
                Ctrl.LaboresCRUD.add(r);
            });
        };
        Ctrl.editarLabor = (L) => {
            console.log(L);
			$mdDialog.show( {
				templateUrl: 'Frag/AdministracionGeneral.Labores_LaborEditorDiag',
				controller: 'Labores_LaborEditorCtrl',
				locals: { Labor: L },
				scope: Ctrl.$new()
			});
		}


        // Ctrl.editarLabor = L => {
        //     Ctrl.LaboresCRUD.dialog(L, {
        //         title: L.labor
        //     }).then(r => {
        //         if (r == "DELETE") return Ctrl.LaboresCRUD.delete(L);
        //         Ctrl.LaboresCRUD.update(r).then(() => {
        //             Rs.showToast("Labor actualizada");
        //         });
        //     });
        // };

        Ctrl.eliminarLabor = L => {
            Rs.confirmDelete({
                Title: "¿Eliminar Labor #" + L.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.LaboresCRUD.delete(L);
            });
        };

        
		
        // Ctrl.abrirOrganigrama = L => {
        //     // console.log(O);
        //     $mdDialog.show({
        //         templateUrl: "Frag/GestionLabor.OrganigramaDiag",
        //         controller: "LaborDiagCtrl",
        //         locals: { Labor: L },
        //         fullscreen: false
        //     });
        // };
    }
]);
