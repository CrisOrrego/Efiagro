<div id="MiFinca" class="divFinca" ng-controller="LotesFincaCtrl" flex layout="column" class="mxw1000">

    {{-- SECCIÓN MI FINCA --}}

    <div ng-repeat="Lote in LotesCRUD.rows">

        <md-card >
            <div layout="row" ng-click = "clickOnCard(Lote)" layout-align="space-between center" style="cursor:pointer;">
                <div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
                    <img ng-src="files/lineasproductivas_media/@{{ Lote.linea_productiva_id }}.jpg" alt="" width="60" height="60">
                    <div class="seccion_texto">
                        <ul ><label class="texto_title">Lineas Productivas: </label> <span class="textoInfo">@{{ Lote.linea_productiva.nombre }}</span></ul>
                        <ul ><span class="textoInfo">@{{ Lote.hectareas }}</span><label class="texto_title"> Hectareas</label>  / <span class="textoInfo">@{{ Lote.sitios }}</span> <label class="texto_title"> Sitios</label></ul> 
                        <ul ><label class="texto_title">Tipo de suelo: </label> <span class="textoInfo">@{{ Lote.finca.tipo_suelo }}</span></ul>                    
                    </div>
                </div>
                <div class="padding-5-20 border-rounded">
                    <i ng-show="!Lote.checked" class="fas fa-chevron-down"></i>
                    <i ng-show="Lote.checked" class="fas fa-chevron-up"></i>                        
                </div>
            </div>
            <div class="check-element" ng-if="Lote.checked" layout="colums" layout-align="center start">
                <md-card class="w100p mxw900 bg-white padding-5-20 border-rounded">
                    <div layout="column" layout-align="space-between none">
                        <div flex >
                            <h6>Labores</h6>
                        </div>

                         <div layout="row" layout-align="space-around center">
                            <div>
                                <i ng-show="indice > 0" ng-click = "clickOnRow('I')" class="fas fa-chevron-left"></i>                         
                            </div>
                            <div>
                                @{{semanas[indice].semana}}
                                <br/>
                                @{{semanas[indice].fechaInicial}} a
                                @{{semanas[indice].fechaFinal}}
                            </div>
                            <div>
                                <i ng-show="indice < semanas.length -1" ng-click = "clickOnRow('D')" class="fas fa-chevron-right"></i>                                                 
                            </div>
                        </div>
                        <div layout layout-align="center center"> 
                            <md-button class="md-raised md-primary" aria-label="Agregar Labor" ng-click="">
                                <md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Labor
                            </md-button>                
                        </div>
                    </div>
                </md-card>
                
                <md-card class="w100p mxw900 bg-white padding-5-20 border-rounded">
                    <div layout="column" layout-align="space-between none">
                        <div flex >
                            <h6>Cosechas</h6>
                        </div>
                        <div layout layout-align="center center"> 
                            <md-button class="md-raised md-primary" aria-label="Agregar Labor" ng-click="">
                                <md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Cosecha
                            </md-button>                
                        </div>
                    </div>
                </md-card>
            </div>
        </md-card>
    </div>
</div>

<style type="text/css">
    .divFinca {
        margin: 10px;
        padding: 10px;
        background: rgb(250, 250, 250);
        background: linear-gradient(0deg, rgba(250, 250, 250, 1) 0%, rgba(255, 255, 255, 0.4066001400560224) 20%, rgba(255, 255, 255, 1) 100%);
    }

    .divInfo {
        padding: 30px;
    }

    .divMap {
        padding: 30px;

    }

    .seccion_texto {
        white-space: normal;
        word-wrap: break-word;
    }
    .texto_title {
        font-weight: bold;
    }  
    .textoInfo {
        /* color: rgb(0, 0, 0); */
        color: rgb(58, 57, 57);
   }
   .img-lote {
        width: 50px;
        height: 50px;
        /* border-radius: 500px; */
    }


    body {
    overflow: hidden;
    perspective: 1000px;
    }

    .check-element {
    /*border: 1px solid black;*/
    opacity: 1;
    padding: 10px;
    }


</style>
