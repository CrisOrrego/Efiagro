<div ng-cloak id="MiFinca" ng-controller="FincasCtrl" class="divMiFinca w650">
    <md-content class="encabezado">
        <md-tabs md-dynamic-height md-border-bottom>
            {{-- SECCIÓN MI FINCA --}}
            <md-tab label="Mi Finca">
                <md-content class="md-padding">

                    <div layout="row" class="w600">
                        <div flex="">
                            <div class="seccion_texto">
                                <label class="texto_title">Dirección:</label>
                                <label class="no-margin">@{{ Finca . direccion }}</label>

                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Departamento:</label>
                                <label class="no-margin">@{{ Finca . departamento_id }}</label>

                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Municipio:</label>
                                <label class="no-margin">@{{ Finca . municipio_id }}</label>

                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Área total:</label>
                                <label class="no-margin">@{{ Finca . area_total }}</label>

                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Tipo Cultivo:</label>
                                <label class="no-margin">@{{ Finca . tipo_cultivo }}</label>
                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Total de lotes:</label>
                                <label class="no-margin">@{{ Finca . total_lotes }}</label>
                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Tipo de suelo:</label>
                                <label class="no-margin">@{{ Finca . tipo_suelo }}</label>
                            </div>

                            <div class="seccion_texto">
                                <label class="texto_title">Zona:</label>
                                <label class="no-margin">@{{ Finca . zona_id }}</label>
                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Hectareas:</label>
                                <label class="no-margin">@{{ Finca . hectareas }}</label>
                            </div>

                            <div class="seccion_texto">
                                <label class="texto_title">Latitud:</label>
                                <label class="no-margin">@{{ Finca . latitud }}</label>
                            </div>
                            <div class="seccion_texto">
                                <label class="texto_title">Longitud.</label>
                                <label class="no-margin">@{{ Finca . longitud }}</label>
                            </div>

                            <div class="seccion_texto">
                                <label class="texto_title">Sitio:s</label>
                                <label class="no-margin">@{{ Finca . sitios }}</label>
                            </div>

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
                                    // Definir los puntos del Polígono
                                    const GCCoords = [{
                                            lat: 4.814954,
                                            lng: -75.707070
                                        },
                                        {
                                            lat: 4.814992,
                                            lng: -75.706985
                                        },
                                        {
                                            lat: 4.814894,
                                            lng: -75.706993
                                        },
                                        {
                                            lat: 4.814897,
                                            lng: -75.707047
                                        },
                                    ];
                                    // Construir el polígono.
                                    const GClocation = new google.maps.Polygon({
                                        paths: GCCoords,
                                        strokeColor: "#FF0000",
                                        strokeOpacity: 0.8,
                                        strokeWeight: 3,
                                        fillColor: "#00ff31",
                                        fillOpacity: 0.35,
                                    });
                                    GClocation.setMap(map); // Asiganr el Polígono al mapa
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

            {{-- SECCIÓN LOTES --}}
            <md-tab label="Lotes">
                <md-content class="md-padding">

                    <md-card class="seccion_lotes" ng-repeat="L in LotesCRUD.rows | filter:filterLotes"
                        ng-click="abrirTarea(T)">
                        <div layout="row">
                            <div flex="10" class="lotes_content">
                                <img class="img-lote" src="/../imgs/platano.png" alt="iconlote">
                            </div>
                            <div flex="" class="lotes_content">
                                <div>
                                    <label class="texto_title">Lote</label> #@{{ L . id }} / <label
                                        class="texto_title">Linea Productiva</label> @{{ L . linea_productiva_id }}
                                    {{-- <h3 class="md-title no-margin">@{{ L . finca_id }}</h3> --}}
                                </div>
                                <div>
                                    @{{ L . hectareas }} <label class="texto_title">Hectareas</label> / <label
                                        class="texto_title">Sitios</label> @{{ L . sitios }}
                                </div>
                                <div>
                                    <label class="texto_tarea"> @{{ L . titulo . length() }} Tareas</label>
                                </div>
                                {{-- <div>
                                    <label class="texto_title">Coordenadas</label>
                                    <h3 class="md-title no-margin">@{{ L . coordenadas }}</h3>
                                </div> --}}
                            </div>
                        </div>
                    </md-card>
                </md-content>

                {{-- SECCIÓN EVENTOS --}}
            </md-tab>
            <md-tab label="Eventos">
                <md-content class="md-padding">


                    <md-card class="seccion_eventos">
                        <div>
                            <h3 class="md-title no-margin">Eventos</h3>
                        </div>

                        <p>Integer turpis erat, porttitor vitae mi faucibus, laoreet interdum tellus. Curabitur
                            posuere molestie dictum. Morbi eget congue risus, quis rhoncus quam. Suspendisse vitae
                            hendrerit erat, at posuere mi. Cras eu fermentum nunc. Sed id ante eu orci commodo
                            volutpat non ac est. Praesent ligula diam, congue eu enim scelerisque, finibus commodo
                            lectus.</p>
                    </md-card>

                </md-content>
            </md-tab>

            {{-- SECCIÓN MI ORGANIZACIÓN --}}
            <md-tab label="Mi Organización" ng-click="">
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

<style type="text/css">
    .divMiFinca {
        margin: 3% auto;
        left: 0;
        right: 0;
    }

    .encabezado {
        border-radius: 1rem;
    }

    .seccion_lotes {
        transform: scale(0.95);
        transition: all 0.3s;
    }

    .seccion_lotes:hover {
        transform: scale(1);
    }

    .seccion_lotes {
        width: 600px;
        padding: 10px;
    }

    md-tabs {
        background-image: url("/../imgs/finca.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }

    md-card {
        min-height: 0%;
        background-color: rgb(255, 248, 240);
    }

    .titulo_navegacion {
        color: rgb(255, 255, 255);

    }

    /* .seccion_finca:hover {
        transform: scale(1);
    } */

    .seccion_texto {
        white-space: normal;
        word-wrap: break-word;
    }

    .texto_title {
        color: rgb(167, 161, 161);
    }

    .texto_tarea {
        color: rgba(247, 20, 20, 0.815);
    }

    .img-lote {
        width: 50px;
        height: 50px;
        /* border-radius: 500px; */
    }

</style>
