
<div id="GestionCultivos" ng-controller="CultivosCtrl" flex layout=column>
<div>
    <div mapa id="map" style="width:800px; height: 400px;overflow: hidden;"></div>
            <md-card class="divInfo">
                <div><md-input-container >
                    <md-select class="divZona" ng-model="zona_select" ng-change="getCultivos()">
                        <md-option  ng-repeat="za in zonas" ng-value="za.id">@{{za.descripcion}}</md-option>
                    </mat-select>
                </md-input-container>
                </div>
                <div>
				<div md-row ng-repeat="C in CultivosCRUD.rows" class="seccion_texto">
					<ul ><label class="texto_title">Fechas</label> <span class="textoInfo">@{{ C.fechas }}</span></ul>
					<ul ><label class="texto_title">Producción</label> <span class="textoInfo">@{{ C.produccion }}<span>kg</span></span></ul>
					<ul ><label class="texto_title">Producción Estimada</label> <span class="textoInfo">@{{ C.produccion_estimada }}<span>kg</span></span></ul>
					<ul ><label class="texto_title">Eventos</label> <span class="textoInfo">@{{ C.eventos }}</span></ul>
					<ul ><label class="texto_title">Creditos Colocados</label> <span class="textoInfo">@{{ C.creditos_colocados }}</span></ul>
					<ul ><label class="texto_title">Cartera Vencida</label> <span class="textoInfo">@{{ C.cartera_vencida }}</span></ul>
					{{-- @{{Articulo.linea_productiva_id}} --}}
				</div>
                
			</md-card>
        </div>
</div>
        <div id="container">
            <div id="sideMenu">
                <div class="meNuIz">
                    <ul class="menu">
                        <li>Fincas Seleccionadas <span class="notification">4</span></li>
                        <li>Lotes Seleccionados <span class="notification">9</span></li>
                        <li>Kg en Producción <span class="notification">56.780</span></li>
                        <li>Kg por Recolectar <span class="notification">2.356</span></li>
                    </ul>
                </div>
            </div>
            <div id="content">
                
                <div class="mainChart">
                    <div id="totalSales">
                    <div class="col">
                        <div ng-controller="CultivosCtrl">
                            <angular-chart options="options" instance="instance"></angular-chart>
                        </div>
                    </div>
                    <div class="col">
                        AQUI CHART
                    </div>
                    <div class="col">
                        AQUI CHART
                    </div>
                    <div class="col">
                        AQUI CHART
                    </div>
                    <div class="col">
                        AQUI CHART
                    </div>
                    <div class="col">
                        AQUI CHART
                    </div>
                    
                    </div>
            
                    <table>
                    <tr>
                        <th>OTROS RESUMEN</th>
                        <th>CANTIDAD</th>
                        <th>Total</th>
                    </tr>
            
                    <tr>
                        <td>Racimos por Lotes</td>
                        <td>20</td>
                        <td>$1,342</td>
                    </tr>
            
                    <tr>
                        <td>Cantodad embolsados</td>
                        <td>18</td>
                        <td>$1,550</td>
                    </tr>
            
                    <tr>
                        <td>Cortes Semanal</td>
                        <td>15</td>
                        <td>$4,170</td>
                    </tr>
            
                    <tr>
                        <td>Producción Ventas</td>
                        <td>25</td>
                        <td>$2,974</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Lato:100,300,400,700);

    html {
    height: 100%;
    font-family: 'Lato', sans-serif;
    }
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
    background: #2c2d2e;
    margin: 60px auto;
    border-radius: 4px;
    }
    /* Side Bar */
    .meNuIz{
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        width: 230px;
        padding: 20px;
        background: #3c3d3d;
    }
    #sideMenu {
    width: 230px;
    height: 100%;
    padding: 20px;
    border-right: 0.5px solid #111;
    display: table-cell;
    vertical-align: top;
    color: #fff;
    }
    .menu {
    list-style: none;
    margin:  14px 0;
    padding: 0;
    }
    .menu li {
    display: block;
    height: 30px;
    width: 100%;
    line-height: 30px;
    /* font-size: 14px; */
    /* font-weight: 200; */
    color: rgba(255, 255, 255, .6);
    position: relative;
    }
    .menu li:hover {
    color: #239ae3;
    }
    
    /* Content */
    #content {
    width: calc(100% - 240px);
    height: 100%;
    padding: 25px;
    display: table-cell;
    }
    .controls {
    display: block;
    width: 70px;
    height: 20px;
    color: rgba(255, 255, 255, 0.4);
    font-size: 10px;
    font-weight: 300;
    text-transform: uppercase;
    text-align: center;
    line-height: 20px;
    float: right;
    border-radius: 20px;
    }
    .activeControl {
    background: rgba(255, 255, 255, 0.9);
    color: #202b33;
    font-weight: 600;
    }
    #salesData {
    margin-bottom: 60px;
    }
    #totalSales {
    height: 120px;
    position: relative;
    margin-top: 24px;
    margin-bottom: 50px;
    }
    #totalSales .col {
    float: left;
    width: 32%;
    height: 150px;
    }
    .col{
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        padding: 10px;
        margin: 0.5%;
        background: #3c3d3d;
        /* height: 49%; */

    }
    /* #totalSales .col .progressTitle {
    float: left;
    margin-left: 20px;
    font-weight: 300;
    color: rgba(255, 255, 255, 0.4);
    } */
    .progressBar {
    float: left;
    height: 120px;
    width: 120px;
    font-size: 40px;
    text-align: center;
    line-height: 120px;
    }

    /* Icons */
    .notification {
    /* display: block; */
    /* width: 30px;
    height: 30px; */
    color: #ffffff;
    font-weight: 600;
    /* line-height: 20px; */
    text-align: center;
    /* border-radius: 50%; */
    /* background: rgba(255, 255, 255, .6); */
    position: absolute;
    top: 0; bottom: 0; right: 2%;
    margin: auto;
    }
    .colorIcon {
    display: block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    position: absolute;
    top: 0; bottom: 0; right: 2%;
    margin: auto;
    }
    .plus {
    display: inline-block;
    width: 20px;
    height: 20px;
    color: #202b33;
    font-weight: 600;
    font-size: 16px;
    line-height: 8px;
    padding: 4px;
    margin-right: 6px;
    border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 50%;
    color: rgba(255, 255, 255, .2);
    }
    .red {
    background: #ec1561;
    }
    .orange {
    background: #ff9939;
    }
    .green {
    background: #2bab51;
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
    h2 {
    float: left;
    font-size: 19px;
    font-weight: 200;
    letter-spacing: 1px;
    margin: 0;
    color: rgba(255, 255, 255, .8);
    }
    h3 {
    float: left;
    color: #fff;
    font-size: 32px;
    font-weight: 300;
    margin: 0;
    margin-top: 8%;
    margin-left: 20px;
    margin-bottom: 6px;
    }
    .clearFix {
    clear: both;
    }
    /*  */
    .divFinca {
        margin: 10px;
        padding: 10px;
        background: rgb(250, 250, 250);
        background: linear-gradient(0deg, rgba(250, 250, 250, 1) 0%, rgba(255, 255, 255, 0.4066001400560224) 20%, rgba(255, 255, 255, 1) 100%);
    }

    .divInfo {
        width: 200PX;  
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

    .divZona{
        box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        width: 200%;
        font-weight: bold;
        border-radius: 10px;

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

{{--  --}}

