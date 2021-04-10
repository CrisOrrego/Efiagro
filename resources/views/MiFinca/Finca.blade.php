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
                                <label class="no-margin">@{{ Finca . zona . descripcion }}</label>
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

                            <div mapa id="map" style="width: 500px;height: 500px;overflow: hidden;"></div>


                        </div>
                    </div>
                </md-content>
            </md-tab>

            {{-- SECCIÓN LOTES --}}
            <md-tab label="Lotes">
                <div layout class="padding-0-10" layout-align="center center">
                    {{-- <div class="md-title">Gestion de Fincas</div> --}}
                    {{-- <span flex></span> --}}
                    <md-input-container class="no-margin md-icon-float" md-no-float>
                        <md-icon md-font-icon="fa-search fa-fw"></md-icon>
                        <input type="text" ng-model="filterLotes" placeholder="Buscar...">
                    </md-input-container>

                    <span flex></span>

                </div>
                <md-content class="md-padding">

                    <md-card class="seccion_lotes" ng-repeat="L in LotesCRUD.rows | filter:filterLotes">
                        <div layout="row">
                            <div flex="10" class="lotes_content">
                                <img class="img-lote" src="/../imgs/platano.png" alt="iconlote">
                            </div>
                            <div flex="" class="lotes_content">
                                <div>
                                    <label class="texto_title">Lote</label> #@{{ L . id }} / <label
                                        class="texto_title">LP</label> @{{ L . linea_productiva . nombre }}
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
                        <div layout="row">
                            <div flex="">
                                <md-card class="seccion_labores" ng-controller="LaboresCtrl">


                                    <md-checkbox ng-controller="LaboresCtrl">
                                        <ul>@{{ L . labor . labor }}</ul>
                                    </md-checkbox>

                                    <md-input-container ng-controller="LaboresCtrl">
                                        <label>AGREGAR LABORES</label>
                                        <md-select ng-model="LotesCtrl">
                                            <md-option ng-value="labores_id" ng-repeat="L in LaboresCRUD.rows">
                                                @{{ L . labor }}</md-option>
                                        </md-select>
                                    </md-input-container>

                                    {{-- <md-button class="md-raised md-primary boton-principal" ng-click="addLabores()">Añadir Labores</md-button> --}}

                                    {{-- <md-input-container ng-controller="LaboresCtrl">
                                    <label>AGREGAR LABORES</label>
                                        <md-select ng-model="LotesCtrl">
                                            <md-option ng-value="labores_id" ng-repeat="L in LaboresCRUD.rows">@{{ L . labor }}</md-option>
                                        </md-select>
                                  </md-input-container> --}}

                            </div>
                    </md-card>

                    <div flex="">
                        <md-card>
                            SECCIÓN GRAFICOS
                        </md-card>
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
        min-height: 0%;
        background-color: rgb(255, 248, 240);
    }

    md-tabs {
        /* background-image: url("/../imgs/finca.jpg"); */
        background-repeat: no-repeat;
        background-size: cover;

    }

    .seccion_labores {}

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
