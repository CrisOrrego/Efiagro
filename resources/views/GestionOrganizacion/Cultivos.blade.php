

<div id="GestionCultivos" ng-controller="CultivosCtrl" flex layout=column>   
    
            <div id="container">
                <div id="sideMenu">
                    <md-card class="divInfo">
                        <div>
                            <md-input-container>
                                <md-select class="divZona" ng-model="zona_select" ng-change="getCultivos()">
                                    <md-option  ng-repeat="za in zonas" ng-value="za.id">@{{za.descripcion}}</md-option>
                                </md-select>
                            </md-input-container>
                        </div>
                        <md-container ng-repeat="C in CultivosCRUD.rows">
                            <table md-table>
                                <tr md-row>
                                    <div class="container">
                                            <div>
                                                <th></th>
                                                <label></label> <md-icon md-font-icon="fas fa-chart-bar"></md-icon><span class="texto_title ">@{{ C.zona.descripcion }}</span>
                                            <div>
                                            <div>
                                                <th></th>
                                                <label class="texto_title">Fechas:</label> <span class="textoInfo">@{{ C.fechas | date:'yyyy-MM-dd'}}</span>
                                            </div>
                                            <div>
                                                <th></th>
                                                <label class="texto_title">Producción:</label> <span class="textoInfo">@{{ C.produccion }}<span>kg</span></span>
                                            </div>
                                                <div>
                                                <th></th>
                                                <label class="texto_title">Producción Estimada:</label> <span class="textoInfo">@{{ C.produccion_estimada }}<span>kg</span></span>
                                            </div>
                                            <div>
                                                <th></th>
                                                <label class="texto_title">Eventos:</label> <span class="textoInfo">@{{ C.eventos }}</span>
                                            </div>
                                                <div>
                                                <th></th>
                                                <label class="texto_title">Creditos Colocados:</label> <span class="textoInfo">@{{ C.creditos_colocados }}</span>
                                            </div>
                                            <div>
                                                <th></th>
                                                <label class="texto_title">Cartera Vencida:</label> <span class="textoInfo">@{{ C.cartera_vencida }}</span>
                                            </div>
                                      
                                    </div>
                                </tr>  
                            </table>
                        </md-container>
                </md-card>
                </div>

                <div id="content">
                            <div mapa id="map" class="colDiv"></div>                      
                        <div id="totalSales">                            
                            <div class="col">
                                <canvas id="myChartLine" width="320" height="320"></canvas>
                            </div>
                            <div class="col">
                                <canvas id="myCharBarras" width="320" height="320"></canvas>
                            </div>
                            <div class="col">
                                <canvas id="myCharCirculo" width="320" height="320"></canvas>
                            </div>
                            <div class="col">
                                <canvas id="myCharPolar" width="320" height="320"></canvas>
                            </div>
                            <div class="col">
                                <canvas id="myCharRadar" width="320" height="320"></canvas>
                            </div>
                            <div class="col">
                               
                            </div>
                            
                            <table>
                            <tr>
                                <th>OTROS RESUMEN</th>
                                <th>CANTIDAD</th>
                                <th>TOTAL</th>
                            </tr>
                    
                            <tr>
                                <td>Racimos por Lotes</td>
                                <td>20</td>
                                <td>$500.000</td>
                            </tr>
                    
                            <tr>
                                <td>Cantidad embolsados</td>
                                <td>18</td>
                                <td>$430.000</td>
                            </tr>
                    
                            <tr>
                                <td>Cortes Semanal</td>
                                <td>15</td>
                                <td>$300.000</td>
                            </tr>
                    
                            <tr>
                                <td>Producción Ventas</td>
                                <td>17</td>
                                <td>$825.000</td>
                            </tr>
                            </table>
                    </div>
                </div>
            </div>
            {{-- CHATS --}}
               
<script>
    var ctx = document.getElementById('myChartLine').getContext('2d');
    var myChartLine = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Lote 1', 'Lote 2', 'Lote 3', 'Lote 4', 'Lote 5', 'Lote 6'],
            datasets: [{
                label: '# Cultivos',
                data: [3, 2, 5, 3, 19, 12],
                backgroundColor: [
                    'rgba(97,11,235, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(109,37,224, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                // borderWidth: 1
            }]
        },
        // options: {
        //     scales: {
        //         y: {
        //             beginAtZero: true
        //         }
        //     }
        // }
    });
    // 
    var ctx = document.getElementById('myCharBarras').getContext('2d');
    var myCharBarras = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Zona 1', 'Zona 2', 'Zona 3', 'Zona 4', 'Zona 5', 'Zona 6'],
            datasets: [{
                label: '# Producción',
                data: [12, 19, 3, 5, 10, 3],
                backgroundColor: [
                    'rgba(97,11,235,0.5)',
                    'rgba(97,11,235,0.5)',
                    'rgba(97,11,235,0.5)',
                    'rgba(97,11,235,0.5)',
                    'rgba(97,11,235,0.5)',
                    'rgba(97,11,235,0.5)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
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
    // 
    var ctx = document.getElementById('myCharCirculo').getContext('2d');
    var myCharCirculo = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Plátano','Café','Mora'],
  datasets: [{
    label: 'Mi Finca',
    data: [300, 50, 100],
    backgroundColor: [
        'rgba(97,11,235, 0.5)',
        'rgb(255, 99, 132, 0.5)',
        'rgb(54, 162, 235, 0.5)',
    ],
    hoverOffset: 4
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

    // 
    var ctx = document.getElementById('myCharPolar').getContext('2d');
    var myCharCirculo = new Chart(ctx, {
        type: 'polarArea',
        data: {
        labels: ['Usuario 1','Usuario 2','Usuario 3','Usuario 4','Usuario 5'],
        datasets: [{
            label: 'My First Dataset',
            data: [11, 16, 7, 3, 14],
            backgroundColor: [
            'rgb(255, 99, 132, 0.5)',
            'rgb(75, 192, 192, 0.5)',
            'rgb(255, 205, 86, 0.5)',
            'rgb(201, 203, 207, 0.5)',
            'rgb(54, 162, 235, 0.5)'
            ]
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

    // 
    var ctx = document.getElementById('myCharRadar').getContext('2d');
    var myCharRadar = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Usuarios','Fincas','Casos','Notificaciones','Eventos','Lotes','Zonas'],
        datasets: [{
            label: 'Organización 1',
            data: [65, 59, 90, 81, 56, 55, 40],
            fill: true,
            backgroundColor: 'rgba(97,11,235,0.5)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }, {
            label: 'Organización 2',
            data: [28, 48, 40, 19, 96, 27, 100],
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
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
            {{-- FIN  --}}
</div>
    
<style type="text/css">
        body {
        height: 100%;
        margin: 0;
        /* background: linear-gradient(135deg, rgba(65,131,155,1) 0%,rgba(51,98,123,1) 100%); */
        background-repeat: no-repeat;
        background-attachment: fixed;
        }
        * {
        box-sizing: border-box;
        }
        #container {
        display: table;
        width: 100%;
        background: #1e1c2c;
        }
        #sideMenu {
        width: 100px;
        height: 100%;
        padding: 10px;
        border-right: 0.5px solid #111;
        display: table-cell;
        vertical-align: top;
        color: #fff;
        }
        #content {
        width: calc(100% - 240px);
        height: 900px;
        display: table-cell;
        }
        #totalSales {
        position: relative;
        margin-top: 24px;
        margin-bottom: 50px;
        }
        .imgChart{
            height: 120px;
            width: 300px;
            position: relative;
            margin: 10px;
            float: left;

        }
        .colDiv{
            height: 400px;
            width: 97%;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            margin: 1.5%;
        }
        #totalSales .col {
        float: left;
        }
        .col{
            height: 330px;
            width: 330px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            padding: 10px;
            margin:1.5%;
            background:#2e2941;     
        }
  
        /* Table */
        table {
        width: 100%;
        border-collapse: collapse;
        }
        th {
        text-align: left;
        color: #fff;
        font-weight: 400;
        font-size: 13px;
        text-transform: uppercase;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0 10px;
        padding-bottom: 14px;
        }
        tr:not(:first-child):hover {
        background: rgba(255, 255, 255, 0.1);
        }
        td {
        height: 40px;
        line-height: 40px;
        font-weight: 300;
        color: rgba(255, 255, 255, 0.4);
        padding: 0 10px;
        }
        /* Headers */
        h1 {
        font-size: 13px;
        font-weight: 200;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin: 0;
        }
        .divInfo {
            width: 300px;  
            padding: 10px;
        }
        .texto_title {
            font-weight: bold;
        }  
        .divZona{
            font-weight: bold;
        }  
        .textoInfo {
            /* color: rgb(0, 0, 0); */
            color: rgb(58, 57, 57);
       }
 

    </style>

    
    
