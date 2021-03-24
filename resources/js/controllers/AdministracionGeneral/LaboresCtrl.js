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
        

        Ctrl.zona_select = null;
        Ctrl.linea_lp_select = null;

        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.LaboresCRUD = $injector.get("CRUD").config({
            base_url: "/api/labores/labores",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"],
            query_with:['zona']
        });

        Ctrl.getLabores = () => {
            console.log(Ctrl.zona_select);
            console.log(Ctrl.linea_lp_select);
            Ctrl.LaboresCRUD.setScope('lazona', Ctrl.zona_select);
            Ctrl.LaboresCRUD.setScope('lalineaproductiva', Ctrl.linea_lp_select);
            
            Ctrl.LaboresCRUD.get().then(() => {
                               
            });
        };

        // $scope.update = function() {
        //     // Ctrl.LaboresCRUD.setScope('lazona', Rs.Labor.zona_id);
        //     $scope.item.size.code = $scope.selectedItem.code
        //     // use $scope.selectedItem.code and $scope.selectedItem.name here
        //  }

       
        // Ctrl.getLabor();

        // Ctrl.nuevaLabor = () => {
        //     Ctrl.LaboresCRUD.dialog({
        //         Flex: 10,
        //         Title: "Crear Labor",
        //         Confirm: { Text: "Crear Labor" }
        //     }).then(r => {
        //         if (!r) return;
        //         Ctrl.LaboresCRUD.add(r);
        //     });
        // };
// 
Ctrl.nuevaLabor = () => {
    Rs.BasicDialog({
        Flex: 30,
        Title: "Crear Labor",
        Fields: [
            
            {
                Nombre: "Labor",
                Value: "",
                Type: "string",
                Required: true
            },
            {
                Nombre: "Zona",
                Value: Ctrl.zona_select,
                Type: "string",
                // List: zona_select,
                Required: true
            },
            {
                Nombre: "Linea Productiva",
                Value: Ctrl.linea_lp_select,
                Type: "string",
                // List: zona_select,
                Required: true
            },
            {
                Nombre: "Frecuencia",
                Value: "",
                Type: "string",
                Required: true
            },
            {
                Nombre: "Semana iInicio",
                Value: "",
                Type: "string",
                Required: true
            },
            {
                Nombre: "Margen",
                Value: "",
                Type: "string",
                Required: true
            }
        ],

        Confirm: { Text: "Crear Labor" }
    }).then(r => {
        if (!r) return;
        var nuevaLabor = {
            labor : r.Fields[0].Value,
            zona_id: r.Fields[1].Value,
            linea_productiva_id: r.Fields[2].Value,
            frecuencia: r.Fields[3].Value,
            semana_inicio: r.Fields[4].Value,
            margen: r.Fields[5].Value,
            

        };
        Ctrl.LaboresCRUD.add(nuevaLabor);
    });
};

// 
        
        Ctrl.editarLabor = (L) => {
            console.log(L);
			$mdDialog.show( { 
				templateUrl: 'Frag/AdministracionGeneral.Labores_LaborEditorDiag',
				controller: 'Labores_LaborEditorCtrl',
				locals: { Labor: L },
				scope: Ctrl.$new()
			});
		}

        Ctrl.eliminarLabor = L => {
            Rs.confirmDelete({
                Title: "¿Eliminar Labor #" + L.id + "?"
            }).then(d => {
                if (!d) return;
                Ctrl.LaboresCRUD.delete(L);
            });
        };

        Ctrl.obtener_lp = () =>{
            return $http.post('api/lineasproductivas/obtener', {}).then(r => {
                Ctrl.lineas_productivas = r.data;
                Ctrl.linea_lp_select = Ctrl.lineas_productivas[0].id;
                
            });

        }
        Ctrl.obtener_zonas = ()=>{
            return $http.post('api/zonas/obtener', {}).then(r => {
                Ctrl.zonas = r.data;
                Ctrl.zona_select = Ctrl.zonas[0].id;
                
            });
        }

        Promise.all([
            Ctrl.obtener_lp(),
            Ctrl.obtener_zonas()
        ]).then(() => {
            Ctrl.getLabores();
        });
	
    }
]);
