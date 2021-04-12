<div ng-cloak id="MiLote" ng-controller="LotesCtrl" class="divMiLote w650">

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
                    </div>
            </md-card>

            <div flex="">
                <md-card>
                    SECCIÓN GRAFICOS
                </md-card>
            </div>
        </md-content>
    </md-tab>
</div>

<style type="text/css">
   
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

    .texto_title {
        color: rgb(167, 161, 161);
    }

    .img-lote {
        width: 50px;
        height: 50px;
        /* border-radius: 500px; */
    }

</style>
