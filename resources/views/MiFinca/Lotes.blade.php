<div id="MiFinca" class="divFinca" ng-controller="LotesFincaCtrl" flex layout="column" class="mxw1000">

    {{-- SECCIÓN MI FINCA --}}

    <div ng-repeat="Lote in LotesCRUD.rows">

        <!--INICIO DEV ANGÉLICA-->
        <md-card >
            <div layout="row" ng-click = "clickOnCard(Lote)" layout-align="space-between center" style="cursor:pointer;">
                <div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
                    <img ng-src="files/lineasproductivas_media/@{{ Lote.linea_productiva_id }}.jpg" alt="" width="60" height="60">
                    <div class="seccion_texto">
                        <ul ><label class="texto_title">LOTE: </label> <span class="textoInfo">@{{ Lote.id }}</span></ul>
                        <ul ><label class="texto_title">Lineas Productivas: </label> <span> @{{ Lote.linea_productiva.nombre }}</span></ul>
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
                        
                         <div layout="row" layout-align="space-around center">
                            <div>
                                <i ng-show="indice > 0" ng-click = "clickOnRow('I', Lote)"  class="fas fa-chevron-left"></i>                         
                            </div>
                            <div>
                                <h5>
                                        @{{semanas[indice].semana}}
                                        <br/>
                                        @{{semanas[indice].semana}} - 
                                        @{{semanas[indice].fechaInicial}} a
                                        @{{semanas[indice].fechaFinal}}                                
                                </h5>                                
                            </div>
                            <div>
                                <i ng-show="indice < semanas.length -1" ng-click = "clickOnRow('D', Lote)" class="fas fa-chevron-right"></i>                                                 
                            </div>
                        </div>
                        <div flex >
                            <h6>Labores</h6>
                        </div>
                        <div ng-repeat="LB in LotesLabores">
                            <ul >
                            <md-checkbox ng-disabled="LB.encontrado || !editable" ng-model="LB.encontrado" ng-click = "guardarLaborRealizada(Lote, LB.labor_id, LB.delta)"> 
                            <div ng-if="LB.delta === -1" style="color: blue">
                                @{{ LB.otraLabor }} 
                            </div>   
                            <div ng-if="LB.delta === 0" style="color: green">
                                @{{ LB.otraLabor }} 
                            </div>                        
                            <div  ng-if="LB.delta === 1" style="color: red">
                                @{{ LB.otraLabor }} 
                            </div>
                            <label class="texto_title">@{{ LB.labor }} </label> <br> <span class="textoInfo">Inicio:  @{{ LB.inicio }} <br> Frecuencia:  @{{ LB.frecuencia }} @{{LB.delta}} </span>

                            </md-checkbox>
                            </ul>                       
                         </div>
                        
                        <div layout layout-align="center center" > 
                            <md-button class="md-raised md-primary" aria-label="Agregar Labor" ng-click="nuevoLoteLabor()">
                                <md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Labor
                            </md-button>                
                        </div>
                    </div>
                </md-card>
                <!--FIN DEV ANGELICA-->
                
                <!--INICIO DEV ANGELICA-->   
                <md-card class="w100p mxw900 bg-white padding-5-20 border-rounded">
                    <div layout="column" layout-align="space-between none">
                        <div flex >
                            <h6>Cosechas</h6>
                        </div>
                        <div layout="row" layout-align="center center">
                            <div class="w320p mxw340 bg-white padding-5-20 border-rounded">
                                <canvas id="myChart" ></canvas>

                                <script>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['01 Ene', '18 Ene', '01 Feb', '18 Feb'],
                                            datasets: [{
                                                label: '# de cosechas',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(75, 192, 192, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                    </script>
                            </div>
                        
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
<!--FIN DEV ANGÉLICA-->