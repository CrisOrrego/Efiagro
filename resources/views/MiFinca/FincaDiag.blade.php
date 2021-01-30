<div id="MiFinca" ng-controller="FincasCtrl" flex layout=column>

    <div ng-cloak>
        <md-content class="encabezado">
            <div layout>

                <md-button class="md-icon-button no-margin" aria-label="salir" ng-click="Salir()">
                    <md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
                </md-button>
            </div>
             
          <md-tabs md-dynamic-height md-border-bottom>  
            <md-tab label="Mi Finca">
              <md-content class="md-padding">
                
                <div layout="row" class="w600">
                    <div flex="">
                            <div class="seccion_texto">
                                <label class="texto_title">Zona</label>
                                <p>@{{ Finca . zona_id }}</p>
                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Hectareas</label>
                                <p>@{{ Finca . hectareas }}</p>
                            </div>

                            <div class="seccion_texto">
                                <label class="texto_title">Latitud</label>
                                <p>@{{ Finca . latitud }}</p>
                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Longitud</label>
                                <p>@{{ Finca . longitud }}</p>
                            </div>

                            <div class="seccion_texto">
                                <label class="texto_title">Sitios</label>
                                <p>@{{ Finca . sitios }}</p>
                            </div>

                        </md-card-content>
                    </div>
                    <div flex="">
                        
                            <script>
                                var map;

                                function initMap() {
                                    map = new google.maps.Map(document.getElementById('map'), {
                                        center: {
                                            lat: 4.814922,
                                            lng: -75.707020
                                        },
                                        mapTypeId: 'satellite',
                                        zoom: 18,
                                        disableDefaultUI: true
                                    });
                                    var marker = new google.maps.Marker({
                                        position: {
                                            lat: 4.814922,
                                            lng: -75.707020
                                        },
                                        map: map
                                    })
                                }

                            </script>
                            <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjjB89k3h2YU7w4NTNQ6euTDtuQ8IeH7g&callback=initMap">
                            </script>
                            <div id="map" style="width: 100%;height: 242px;overflow: hidden;"></div>
                        </md-card-content>
                    </div>
                </div>
              </md-content>
            </md-tab>
            <md-tab label="Lotes">
              <md-content class="md-padding">
               
                                
                    <div layout=column flex layout-align="start center" class="padding">
                        
                        <md-card ng-repeat="L in LotesCRUD.rows" layout=column class="padding w100p mxw600 pointer"
                            ng-click="abrirLote(L)">
                            <div layout layout-align="space-between center margin-bottom-5">
                                <div>
                                    <h3 class="md-title no-margin">@{{ L.id }}</h3>
                                </div>
                            </div>
                            <div class="text-darkgreen text-bold text-14px">
                                @{{ L.novedades.length }} @{{ Caso.novedades.length == 1 ? 'Respuesta' : 'Respuestas' }}
                            </div>
                        </md-card>
                    </div>
                
              </md-content>
            </md-tab>
            <md-tab label="Eventos">
              <md-content class="md-padding">
                
                <p>Integer turpis erat, porttitor vitae mi faucibus, laoreet interdum tellus. Curabitur
                  posuere molestie dictum. Morbi eget congue risus, quis rhoncus quam. Suspendisse vitae
                  hendrerit erat, at posuere mi. Cras eu fermentum nunc. Sed id ante eu orci commodo
                  volutpat non ac est. Praesent ligula diam, congue eu enim scelerisque, finibus commodo
                  lectus.</p>
              </md-content>
            </md-tab>
            <md-tab label="Mi Organización">
              <md-content class="md-padding">
               
                <p>Integer turpis erat, porttitor vitae mi faucibus, laoreet interdum tellus. Curabitur
                  posuere molestie dictum. Morbi eget congue risus, quis rhoncus quam. Suspendisse vitae
                  hendrerit erat, at posuere mi. Cras eu fermentum nunc. Sed id ante eu orci commodo
                  volutpat non ac est. Praesent ligula diam, congue eu enim scelerisque, finibus commodo
                  lectus.</p>
              </md-content>
            </md-tab>
          </md-tabs>
        </md-content>
      </div>
          
   
    <!--cerrar contenedor principal-->
</div>


<style type="text/css">
    .seccion_finca {
        transform: scale(0.95);
        transition: all 0.3s;

    }

    .titilo-finca {
        text-align: center;
        white-space: normal;
        word-wrap: break-word;
        color: rgb(255, 255, 255);
		
    }
    .titulo_navegacion{
        color: rgb(255, 255, 255);

    }

    /* .seccion_finca:hover {
        transform: scale(1);
    } */
	.encabezado{
		background-image: url("/../imgs/finca.jpg");

	}

    /* .content {
        /* background-image: url("/../imgs/finca.jpg"); */
        width: 80%;
        min-height: 200px;
		align-content: center;
		
   } */

     .seccion_texto {
        white-space: normal;
        word-wrap: break-word;
    }

    .texto_title {
        /* text-align: center;
height: 40px; */
        color: rgb(199, 196, 196);
        /* font-size: 1.2rem;
text-shadow: 0 0 5px black; */


    }


</style>
