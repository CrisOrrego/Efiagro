angular.module("OrganizacionesCtrl", []).controller("OrganizacionesCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("OrganizacionesCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.Salir = $mdDialog.cancel;
		
        Ctrl.OrganizacionesCRUD = $injector.get("CRUD").config({
            base_url: "/api/organizaciones/organizaciones",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getOrganizaciones = () => {
            Ctrl.OrganizacionesCRUD.get().then(() => {
                //Ctrl.editarOrganizacion(Ctrl.OrganizacionesCRUD.rows[0]);
            });
        };

        Ctrl.getOrganizaciones();

        Ctrl.nuevaOrganizacion = () => {
            Ctrl.OrganizacionesCRUD.dialog({
                Flex: 10,
				Title: 'Crear Organización',
				
				Confirm: { Text: 'Crear Organizacion' },
            }).then(r => {
                if (!r) return;
                Ctrl.OrganizacionesCRUD.add(r);
            });
        };

        Ctrl.editarOrganizacion = (O) => {
			Ctrl.OrganizacionesCRUD.dialog(O, {
				title: 'Editar Organización' + O.nombre
			}).then(r => {
				if(r == 'DELETE') return Ctrl.OrganizacionesCRUD.delete(O);
				Ctrl.OrganizacionesCRUD.update(r).then(() => {
					Rs.showToast('Organizacion actualizada');
				});
			});
		}

		Ctrl.eliminarOrganizacion = (O) => {
			Rs.confirmDelete({
				Title: '¿Eliminar Organizacion #'+O.id+'?',
			}).then(d => {
				if(!d) return;
				Ctrl.OrganizacionesCRUD.delete(O);
			});
        }

		Ctrl.abrirOrganizacion = (O) => {
			$mdDialog.show({
				templateUrl: 'Frag/GestionOrganizacion.OrganizacionDiag',
				controller: 'OrganizacionesCtrl',
				locals: { Organizacion: O },
				fullscreen: false,
			});
        }
        
        
    }
]);



