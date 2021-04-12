<div id="MiFinca" class="divFinca" ng-controller="FincasCtrl" flex layout="column" class="mxw1000">

    {{-- SECCIÓN MI FINCA --}}

    <div layout="row" >
        <div class="divInfo" flex="" layout layout-wrap>
            <div class="seccion_texto">
                <ul ><label class="texto_title">Dirección:</label> <span class="textoInfo">@{{ Finca . direccion }}</span></ul>
                <ul ><label class="texto_title">Departamento: <span class="textoInfo">@{{ Finca . departamento_id }}</span></ul>
                <ul ><label class="texto_title">Municipio: <span class="textoInfo">@{{ Finca . municipio_id }}</span></ul>
                <ul ><label class="texto_title">Área total: <span class="textoInfo">@{{ Finca . area_total }}</span></ul>
                <ul ><label class="texto_title">Tipo Cultivo: <span class="textoInfo">@{{ Finca . tipo_cultivo }}</span></ul>
                <ul ><label class="texto_title">Total de lotes: <span class="textoInfo">@{{ Finca . total_lotes }}</span></ul>
                <ul ><label class="texto_title">Tipo de suelo: <span class="textoInfo">@{{ Finca . tipo_suelo }}</span></ul>
                <ul ><label class="texto_title">Zona: <span class="textoInfo">@{{ Finca . zona . descripcion }}</span></ul>
                <ul ><label class="texto_title">Hectareas: <span class="textoInfo">@{{ Finca . latitud }}</span></ul>
                <ul ><label class="texto_title">Latitud: <span class="textoInfo">@{{ Finca . latitud }}</span></ul>
                <ul ><label class="texto_title">Longitud: <span class="textoInfo">@{{ Finca . longitud }}</span></ul>
                <ul ><label class="texto_title">Sitio: <span class="textoInfo">@{{ Finca . sitios }}</span></ul>
            </div>
        </div>

        <div flex="" layout layout-wrap class="divMap">
            <div mapa id="map" style="width:800px; height: 400px;overflow: hidden;"></div>
        </div>
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
        color: rgb(58, 57, 57);
   }
    .textoInfo {
        color: rgb(0, 0, 0);
   }

    .img-lote {
        width: 50px;
        height: 50px;
        /* border-radius: 500px; */
    }

</style>
