angular.module("LotesFincaCtrl", []).controller("LotesFincaCtrl", [
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
            Ctrl.LotesCRUD.setScope("finca_id", Rs.Usuario.finca_id); //Me trae los lotes de una finca
            Ctrl.LotesCRUD.get().then(() => {
                Ctrl.Lotes = Ctrl.LotesCRUD.rows;
                //Ctrl.editarLote(Ctrl.LotesCRUD.rows[0]);
            });
        };

        Ctrl.getLotes();

        Ctrl.clickOnCard = (lote) => {
            //Las siguientes lineas cierran todos los paneles y deja abierto solo el panel seleccionado
            if(lote.checked){
                lote.checked = false;
            }else{
                Ctrl.Lotes.forEach(L => {
                    L.checked = false;
                });
                lote.checked = true; 
            }
            /*
            //Estas líneas solo abren o cierran el panel seleccionado, es decir, deja visualizar varios a la vez
            if(!lote.checked){
                lote.checked = true;
            }else{
                lote.checked = !lote.checked;
            }*/
        }
          
    }
]);
