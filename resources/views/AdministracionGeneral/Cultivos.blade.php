<div id="GestionCultivos" ng-controller="CultivosCtrl" flex layout=column>
    <div id="container">
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
                    <canvas id="creditos" width="320" height="320"></canvas>
                </div>
                <div class="col">
                    <canvas id="creditosLinea" width="320" height="320"></canvas>
                </div>
                <div class="col">
                    <div class="info-numerica">
                        <div class="valor">37</div>
                        <div class="titulo">Créditos</div>
                    </div>
                    <div class="info-numerica">
                        <div class="valor">$49.700.000,00</div>
                        <div class="titulo">Asignación</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChartLine').getContext('2d');
        var myChartLine = new Chart(ctx, {
        //type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
            datasets: [{
                type: 'line',
                label: 'PRODUCCIÓN',
                data: [6, 8, 10, 17, 19, 12],
                borderColor: [
                    '#47dd37'
                ]
            },{
                type: 'line',
                label: 'ESTABLECIMIENTO',
                data: [6, 6, 5, 4, 3,5],
                borderColor: [
                    '#cf9736'
                ]
            },{
                type: 'bar',
                label: 'AREA TOTAL',
                data: [12, 15,18, 22, 25, 28],
                backgroundColor: [
                    'rgba(97,11,235,0.5)'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                        display: true,
                        text: 'COBERTURA PRODUCTIVA'
                    }
            }
        }
        });


        // Inicio datos informe produccion.
        var ctx = document.getElementById('myCharBarras').getContext('2d');
        var myCharBarras = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Bim 5', 'Bim 6', 'Bim 1', 'Bim 2', 'Zona 3', 'Zona 4', 'PROY'],
            datasets: [{
                label: 'Promedio',
                data: [13.6, 12.7, 13.2, 15, 14.1, 15.9,14.3],
                backgroundColor: [
                    '#6b77be',
                    '#6b77be',
                    '#6b77be',
                    '#6b77be',
                    '#6b77be',
                    '#6b77be',
                    '#23d959'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                        display: true,
                        text: 'PROMEDIOS DE PRODUCCIÓN'
                    }
            }
        }
        });

        //
        var ctx = document.getElementById('creditos').getContext('2d');
        var myCharBarras = new Chart(ctx, {
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'COLOCACIÓN',
                type: 'line',
                data: [5000000,7500000,14500000,6000000,8500000,5750000,2450000],
                backgroundColor: [
                    '#d3ea15'
                ],
                borderColor : [
                    '#d3ea15'
                ],
                yAxisID : 'y1'
            },{
                label: 'CREDITOS',
                type: 'bar',
                data: [5,7,10,3,4,6,2],
                backgroundColor: [
                    '#be6b6b'
                ],
                yAxisID : 'y'
            }]
        },
        options: {
            responsive: true,
            interaction: {
            mode: 'index',
            intersect: false,
            },
            stacked: false,
            plugins: {
            title: {
                display: true,
                text: 'COLOCACIÓN vs CRÉDITOS'
            }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    // grid line settings
                    grid: {
                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                    },
                },
            }
        }
        });
        //
        var ctx = document.getElementById('creditosLinea').getContext('2d');
        var myCharBarras = new Chart(ctx, {
        data: {
            labels: ['Equipo', 'Infra.'],
            datasets: [{
                label: 'Asignación x Linea',
                type: 'bar',
                data: [7500000,14500000],
                backgroundColor: [
                    '#d3ea15'
                ],
                borderColor : [
                    '#d3ea15'
                ],
                yAxisID : 'y1'
            },{
                label: 'Créditos',
                type: 'bar',
                data: [5,7],
                backgroundColor: [
                    '#be6b6b'
                ],
                yAxisID : 'y'
            }]
        },
        options: {
            responsive: true,
            interaction: {
            mode: 'index',
            intersect: false,
            },
            stacked: false,
            plugins: {
            title: {
                display: true,
                text: 'COLOCACIÓN Y CRÉDITOS X LINEA'
            }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    // grid line settings
                    grid: {
                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                    },
                },
            }
        }
        });
    </script>

</div>

<style type="text/css">
    body {
        height: 100%;
        margin: 0;
        background-color: #fff;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    * {
    box-sizing: border-box;
    }
    #container {
        display: table;
        width: 100%;
        background: #fff;
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
        height: auto;
        min-height: 380px;
        width: 30%;
        min-width: 330px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        padding: 10px;
        margin:1.5%;
        background:#2e2941;
    }
    @media only screen and (max-width: 960px) {
        .col{
            width:45%;
        }
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

    .info-numerica{
        display:block;
        margin-bottom: 30px;
    }
    .info-numerica .valor{
        font-size: 3rem;
        color: #15eabf;
        text-align: center;
    }
    .info-numerica .titulo{
        text-align:center;
        font-size: 1.3rem;
        color: #eaeaea;
    }
</style>
