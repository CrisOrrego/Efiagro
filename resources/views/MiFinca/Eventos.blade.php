<div id="FincaEvento" class="divFinca" ng-controller="EventosCtrl" flex layout="column" class="mxw1000">

    <div ng-repeat="FE in FincaEventosCRUD.rows">

        <md-card >
            <div layout="row" ng-click = "clickOnCard(FE)" layout-align="space-between center" style="cursor:pointer;">
                <div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
                    <img ng-src="files/eventos_media/@{{ FE.id }}.jpg" alt="" width="60" height="60">
                    <div class="seccion_texto">
                        
                        <ul ><span class="textoInfo">@{{ FE.evento }}</span><label class="texto_title"> Hectareas</label>  / <span class="textoInfo">@{{ Lote.sitios }}</span> <label class="texto_title"> Sitios</label></ul> 
                        <ul ><span class="textoInfo">@{{ FE.nombre }}</span><label class="texto_title"> Hectareas</label>  / <span class="textoInfo">@{{ Lote.sitios }}</span> <label class="texto_title"> Sitios</label></ul> 
                                  
                    </div>
                </div>
              
            </div>
            <div class="check-element" ng-if="Lote.checked" layout="colums" layout-align="center start">
                <md-card class="w100p mxw900 bg-white padding-5-20 border-rounded">
                    <div layout="column" layout-align="space-between none">
                      
                        <div layout layout-align="center center"> 
                            <md-button class="md-raised md-primary" aria-label="Agregar Labor" ng-click="">
                                <md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Evento
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

</style>
