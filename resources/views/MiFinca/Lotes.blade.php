<div id="MiFinca" class="divFinca" ng-controller="LotesFincaCtrl" flex layout="column" class="mxw1000">

    {{-- SECCIÓN MI FINCA --}}

    <div ng-repeat="Lote in LotesCRUD.rows" flex>

        <md-card >
                <div layout="row" flex="" layout layout-wrap>
                    <div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
                    <img ng-src="files/lineasproductivas_media/@{{ Lote.linea_productiva_id }}.jpg" alt="" width="60" height="60">
                        <div class="seccion_texto">
                            <ul ><label class="texto_title">Lineas Productivas: </label> <span class="textoInfo">@{{ Lote.linea_productiva.nombre }}</span></ul>
                            <ul ><span class="textoInfo">@{{ Lote.hectareas }}</span><label class="texto_title"> Hectareas</label>  / <span class="textoInfo">@{{ Lote.sitios }}</span> <label class="texto_title"> Sitios</label></ul> 
                            <ul ><label class="texto_title">Tipo de suelo: </label> <span class="textoInfo">@{{ Lote.finca.tipo_suelo }}</span></ul>                    
                        </div>
                    </div>
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
