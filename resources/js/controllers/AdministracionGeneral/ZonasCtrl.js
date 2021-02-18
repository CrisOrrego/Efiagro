angular.module("ZonasCtrl", []).controller("ZonasCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {
        console.info("ZonasCtrl");
        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.Salir = $mdDialog.cancel;
		
        Ctrl.ZonasCRUD = $injector.get("CRUD").config({
            base_url: "/api/zonas/zonas",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"]
        });

        Ctrl.getZona = () => {
            // Ctrl.ZonasCRUD.setScope('id', Rs.Usuario.Zona_id);
            Ctrl.ZonasCRUD.get().then(() => {
                Ctrl.Zona = Ctrl.ZonasCRUD.rows[0];
                //Ctrl.editarZona(Ctrl.ZonasCRUD.rows[0]);
            });
        };

        Ctrl.getZona();

        Ctrl.nuevaZona = () => {
            Ctrl.ZonasCRUD.dialog({
                Flex: 10,
				Title: 'Crear Zona',
				
				Confirm: { Text: 'Crear Zona' },
            }).then(r => {
                if (!r) return;
                Ctrl.ZonasCRUD.add(r);
            });
        };

        Ctrl.editarZona = (Z) => {
			Ctrl.ZonasCRUD.dialog(Z, {
				title: 'Editar Zona' + Z.descripcion
			}).then(r => {
				if(r == 'DELETE') return Ctrl.ZonasCRUD.delete(z);
				Ctrl.ZonasCRUD.update(r).then(() => {
					Rs.showToast('Zona actualizada');
				});
			});
		}

		Ctrl.eliminarZona = (Z) => {
			Rs.confirmDelete({
				Title: '¿Eliminar Zona #'+Z.id+'?',
			}).then(d => {
				if(!d) return;
				Ctrl.ZonasCRUD.delete(Z);
			});
        }

		Ctrl.abrirOrganigrama = (Z) => {
            // console.log(O);
			$mdDialog.show({
				templateUrl: 'Frag/GestionZona.OrganigramaDiag',
				controller: 'ZonaDiagCtrl',
				locals: { Zona: Z },
				fullscreen: false,
			});
        }
        
        
    }
]);



