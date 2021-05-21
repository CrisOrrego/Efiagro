<div ng-cloak id="Eventos" ng-controller="EventosCtrl" class="divEventos w650">
    {{-- SECCIÓN EVENTOS --}}
    <div ng-repeat="E in LotesCRUD.rows">

        <md-card >
            <div layout="row" ng-click = "clickOnCard(E)" layout-align="space-between center" style="cursor:pointer;">
                <div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
                    <img ng-src="files/eventos_media/@{{ E.id }}.jpg" alt="" width="60" height="60">
                    <div class="seccion_texto">
                        <ul ><label class="texto_title">Lineas Productivas: </label> <span class="textoInfo">@{{ E.EVENTO }}</span></ul>
                        {{-- <ul ><span class="textoInfo">@{{ Lote.hectareas }}</span><label class="texto_title"> Hectareas</label>  / <span class="textoInfo">@{{ Lote.sitios }}</span> <label class="texto_title"> Sitios</label></ul> 
                        <ul ><label class="texto_title">Tipo de suelo: </label> <span class="textoInfo">@{{ Lote.finca.tipo_suelo }}</span></ul>                     --}}
                    </div>
                </div>
                
            </div>
            <div class="check-element" ng-if="Lote.checked" layout="colums" layout-align="center start">
                <md-card class="w100p mxw900 bg-white padding-5-20 border-rounded">
                    <div layout="column" layout-align="space-between none">
                        <div flex >
                            <h6>eVENTOS</h6>
                        </div>
                        <div layout layout-align="center center"> 
                            <md-button class="md-raised md-primary" aria-label="Agregar Labor" ng-click="">
                                <md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Eventos
                            </md-button>                
                        </div>
                    </div>
                </md-card>
                
              
            </div>
        </md-card>
    </div>
    </md-tab>
</div>

<style type="text/css">
   
    .encabezado {
        border-radius: 1rem;
    }

</style>
