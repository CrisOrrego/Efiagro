angular.module("CultivosCtrl", []).controller("CultivosCtrl", [
    "$scope",
    "$rootScope",
    "$http",
    "$injector",
    "$mdDialog",
    function($scope, $rootScope, $http, $injector, $mdDialog) {

        var Ctrl = $scope;
        var Rs = $rootScope;

        Ctrl.zona_select = null;
        
        Ctrl.Salir = $mdDialog.cancel;

        Ctrl.value = 0;


           Ctrl.CultivosCRUD = $injector.get("CRUD").config({
            base_url: "/api/cultivos/cultivos",
            limit: 1000,
            add_append: "refresh",
            order_by: ["-created_at"],
            query_with:['zona', 'evento']
        });

        Ctrl.getCultivos = () => {
            Ctrl.CultivosCRUD.setScope('lazona', Ctrl.zona_select);  
            Ctrl.CultivosCRUD.get().then(() => {
                   
            });
           
        };

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
        // 

        // 

        Promise.all([
            Ctrl.obtener_zonas()
        ]).then(() => {
            Ctrl.getCultivos();
        });

        Ctrl.crearMapa = function(){
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 4.852147911841803, lng: -75.5747982566813},
                mapTypeId: 'satellite',
                zoom: 16,
                disableDefaultUI: false
            });
        
            $scope.map = map;
            
            const iconBase = "http://efiagro.local/imgs/";
            const icons = {
                finca: {
                icon: iconBase + "finca-icono.png",
                }
            };
            const datosFincas = {
                finca1 : {
                    centro : {lat: 4.852147911841803, lng: -75.5747982566813},
                    hectareas : 1.2,
                },
                finca2: {
                    centro : { lat: 4.852843  , lng: -75.572138 },
                    hectareas : 0.75,
                },
                finca3: {
                    centro : { lat: 4.854233  , lng: -75.577974 },
                    hectareas : 1,
                },
                finca4: {
                    centro : { lat: 4.848726  , lng: -75.573670 },
                    hectareas : 0.85,
                },
            }
        
            for(const datoFinca in datosFincas){
                const circulo = new google.maps.Circle({
                    strokeColor: "#f2bf30",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#f27e30",
                    fillOpacity: 0.45,
                    map,
                    center: datosFincas[datoFinca].centro,
                    radius: datosFincas[datoFinca].hectareas*100,
                  });
                
                  var markerFincas = new google.maps.Marker({position: datosFincas[datoFinca].centro, icon: icons["finca"].icon, map: map});
            }
            
            var marker = new google.maps.Marker({position: {lat: 4.852147911841803, lng: -75.5747982566813}, icon: icons["finca"].icon, map: map});
        
            const infoMarker = `<b>Esta es la prueba de la información para Julian y Juan</b>`;
            const infoWindow = new google.maps.InfoWindow({
                content: infoMarker,
            });
            marker.addListener("click", () => {
                infoWindow.open(map,marker);
            });
            // Define the LatLng coordinates for the polygon.
        
            // const GCCoords = JSON.parse(coordenadas);
            const GCCoords = [
                { "lat": 4.850726639851928  , "lng": -75.575134148821235  },
                { "lat": 4.850728400051594  , "lng": -75.575136328116059  },
                { "lat": 4.850811045616865  , "lng": -75.575285442173481  },
                { "lat": 4.850812889635563  , "lng": -75.575296422466636  },
                { "lat": 4.850881118327379  , "lng": -75.5754105001688  },
                { "lat": 4.850978180766106  , "lng": -75.575610073283315  },
                { "lat": 4.850978180766106  , "lng": -75.575612252578139  },
                { "lat": 4.851046409457922  , "lng": -75.575732868164778  },
                { "lat": 4.85116945579648  , "lng": -75.575770167633891  },
                { "lat": 4.851228799670935  , "lng": -75.575770167633891  },
                { "lat": 4.851261069998145  , "lng": -75.575794307515025  },
                { "lat": 4.851345559582114  , "lng": -75.575781147927046  },
                { "lat": 4.851345559582114  , "lng": -75.57578332722187  },
                { "lat": 4.851390486583114  , "lng": -75.575798666104674  },
                { "lat": 4.851440778002143  , "lng": -75.575864464044571  },
                { "lat": 4.851500038057566  , "lng": -75.575844682753086  },
                { "lat": 4.851552173495293  , "lng": -75.575772346928716  },
                { "lat": 4.851552173495293  , "lng": -75.575770167633891  },
                { "lat": 4.851584527641535  , "lng": -75.575730688869953  },
                { "lat": 4.851586287841201  , "lng": -75.575730688869953  },
                { "lat": 4.851634819060564  , "lng": -75.575737226754427  },
                { "lat": 4.851728277280927  , "lng": -75.575844682753086  },
                { "lat": 4.851789297536016  , "lng": -75.575824985280633  },
                { "lat": 4.851789297536016  , "lng": -75.575822805985808  },
                { "lat": 4.851827016100287  , "lng": -75.575792044401169  },
                { "lat": 4.851858532056212  , "lng": -75.575729599222541  },
                { "lat": 4.851858532056212  , "lng": -75.575720882043242  },
                { "lat": 4.85189801082015  , "lng": -75.57567042298615  },
                { "lat": 4.851973447948694  , "lng": -75.575600266456604  },
                { "lat": 4.8520543333143  , "lng": -75.575560787692666  },
                { "lat": 4.852109989151359  , "lng": -75.575538827106357  },
                { "lat": 4.852140583097935  , "lng": -75.575519045814872  },
                { "lat": 4.852224988862872  , "lng": -75.575424749404192  },
                { "lat": 4.852307634428144  , "lng": -75.575347971171141  },
                { "lat": 4.852307634428144  , "lng": -75.575345791876316  },
                { "lat": 4.852334624156356  , "lng": -75.575321651995182  },
                { "lat": 4.852334624156356  , "lng": -75.575242694467306  },
                { "lat": 4.852357925847173  , "lng": -75.57518133893609  },
                { "lat": 4.852453144267201  , "lng": -75.575168179348111  },
                { "lat": 4.85253126360476  , "lng": -75.575197767466307  },
                { "lat": 4.852599492296577  , "lng": -75.575215285643935  },
                { "lat": 4.852730669081211  , "lng": -75.575138507410884  },
                { "lat": 4.852797137573361  , "lng": -75.575048653408885  },
                { "lat": 4.852834856137633  , "lng": -75.574952093884349  },
                { "lat": 4.852834856137633  , "lng": -75.574949914589524  },
                { "lat": 4.852861845865846  , "lng": -75.574901634827256  },
                { "lat": 4.852901324629784  , "lng": -75.57485343888402  },
                { "lat": 4.852948011830449  , "lng": -75.574816139414907  },
                { "lat": 4.853025292977691  , "lng": -75.574800800532103  },
                { "lat": 4.853023532778025  , "lng": -75.574800800532103  },
                { "lat": 4.85317088663578  , "lng": -75.5747733078897  },
                { "lat": 4.85317088663578  , "lng": -75.574771128594875  },
                { "lat": 4.853284126147628  , "lng": -75.574760148301721  },
                { "lat": 4.853343386203051  , "lng": -75.574720669537783  },
                { "lat": 4.853370292112231  , "lng": -75.574714047834277  },
                { "lat": 4.853402646258473  , "lng": -75.574705330654979  },
                { "lat": 4.853363167494535  , "lng": -75.574657050892711  },
                { "lat": 4.853361323475838  , "lng": -75.574654871597886  },
                { "lat": 4.853298459202051  , "lng": -75.574582451954484  },
                { "lat": 4.853258896619082  , "lng": -75.574492514133453  },
                { "lat": 4.853226626291871  , "lng": -75.574389500543475  },
                { "lat": 4.853214053437114  , "lng": -75.574312722310424  },
                { "lat": 4.853212209418416  , "lng": -75.574312722310424  },
                { "lat": 4.853185303509235  , "lng": -75.574152627959847  },
                { "lat": 4.853199636563659  , "lng": -75.574034191668034  },
                { "lat": 4.853208689019084  , "lng": -75.573920197784901  },
                { "lat": 4.853208689019084  , "lng": -75.573762282729149  },
                { "lat": 4.853201564401388  , "lng": -75.573635045439005  },
                { "lat": 4.853215897455812  , "lng": -75.573582407087088  },
                { "lat": 4.852939210832119  , "lng": -75.57362406514585  },
                { "lat": 4.852757742628455  , "lng": -75.573689863085747  },
                { "lat": 4.852755982428789  , "lng": -75.573689863085747  },
                { "lat": 4.852480133995414  , "lng": -75.573856579139829  },
                { "lat": 4.852042766287923  , "lng": -75.574178947135806  },
                { "lat": 4.851759793236852  , "lng": -75.574416909366846  },
                { "lat": 4.851539684459567  , "lng": -75.574608854949474  },
                { "lat": 4.851218992844224  , "lng": -75.57467021048069  },
                { "lat": 4.851070884615183  , "lng": -75.57471077889204  },
                { "lat": 4.851068202406168  , "lng": -75.57471077889204  },
                { "lat": 4.850981952622533  , "lng": -75.574770038947463  },
                { "lat": 4.850979270413518  , "lng": -75.5747733078897  },
                { "lat": 4.850911879912019  , "lng": -75.574868693947792  },
                { "lat": 4.850728651508689  , "lng": -75.575131885707378 }
              ];
        
            // Construct the polygon.
            const GClocation = new google.maps.Polygon({
                paths: GCCoords,
                strokeColor: "#a3e5b2",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#a3e5b2",
                fillOpacity: 0.45,
              });
              GClocation.setMap(map);
        }
        
	
}])
.directive("mapa",[function(){
    return {
        restrict : "A",
        link : function($scope, element, attrs){
            $scope.crearMapa();
        }
      };
}]);
