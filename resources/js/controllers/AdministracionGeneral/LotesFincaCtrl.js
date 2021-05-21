angular.module("LotesFincaCtrl", []).controller("LotesFincaCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {

        var Ctrl = $scope;
        var Rs = $rootScope;
        Ctrl.indice = 0;
        
        Ctrl.semanas = [
            {
                id:1, semana:'semana 01', fechaInicial:'2021-01-07', fechaFinal:'2021 2021-12-15'
            },
            {
                id:2, semana:'semana 02', fechaInicial:'2021-01-08', fechaFinal:'2021 2021-12-15'
            },
            {
                id:3, semana:'semana 03', fechaInicial:'2021-01-15', fechaFinal:'2021 2021-12-15'
            }
        ];
       
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

        //INICIO DEV ANGÉLICA
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
        //FIN DEV ANGELICA

        //INICIO DEV ANGÉLICA
        //O = Orientación de las flechas - si la orientacion es derecha el indice debe incrementarse en 1, si es izq 
        //D = Derecha
        Ctrl.clickOnRow = (O) => {
            if(O === 'D') {
                if(Ctrl.indice < Ctrl.semanas.length-1){
                    Ctrl.indice ++;
                }
            }else{
                if(Ctrl.indice > 0){
                    Ctrl.indice --;
                }
            }
        }
        //FIN DEV ANGELICA
          
    }
]);
