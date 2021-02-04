<div id="GestionFincas" ng-controller="FincasCtrl" flex layout=column>

    <div layout class="padding-0-10" layout-align="center center">
        <div class="md-title">Fincas</div>
        <md-input-container class="no-margin md-icon-float" md-no-float>
            <md-icon md-font-icon="fa-search fa-fw"></md-icon>
            <input type="text" ng-model="filterFincas" placeholder="Buscar...">
        </md-input-container>
        <span flex></span>
    </div>


    <div class='md-padding' layout="row" layout-wrap>
        <md-card ng-repeat="F in FincasCRUD.rows | filter:filterFincas" class="seccion_finca" flex-sm="25"
            flex-gt-sm="30" flex="100">

            <div align="center"><img class="img-finca" src="/../imgs/Finca.jpg" alt="iconfinca"></div>
            <md-card-title class="titilo-finca">
                <h2>@{{ F . nombre }}</h2>
            </md-card-title>

            <md-button class="md-raised md-primary" aria-label="Ver" ng-click="abrirFinca(F)">
                <md-icon md-font-icon="open_with"></md-icon>Ver detalles
            </md-button>

        </md-card>

    </div>
</div>


<style type="text/css">
    .seccion_finca {
        transform: scale(0.95);
        transition: all 0.3s;

    }
    .seccion_finca:hover {
        transform: scale(1);
    }

    .titilo-finca {
        text-align: center;
    }

   

    md-card {
        min-height: 200px;

    }

    .img-finca {
        width: 100px;
        height: 100px;
        border-radius: 500px;
    }

</style>
