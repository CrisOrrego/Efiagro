<div id="GestionCultivos" ng-controller="CultivosCtrl" flex layout=column>
	
	<div layout="row" >
		<div class="divInfo" flex="" layout layout-wrap>
			<md-card flex class="no-margin-top">
				<div class="seccion_texto" >
					<ul ><label class="texto_title">Fechas</label> <span class="textoInfo">@{{ Cultivo.fechas }}</span></ul>
					<ul ><label class="texto_title">Zona</label> <span class="textoInfo">@{{ Cultivo.zona_id }}</span></ul>
					<ul ><label class="texto_title">Producción</label> <span class="textoInfo">@{{ Cultivo.produccion }}<span>kg</span></span></ul>
					<ul ><label class="texto_title">Producción Estimada</label> <span class="textoInfo">@{{ Cultivo.produccion_estimada }}<span>kg</span></span></ul>
					<ul ><label class="texto_title">Eventos</label> <span class="textoInfo">@{{ Cultivo.eventos }}</span></ul>
					<ul ><label class="texto_title">Creditos Colocados</label> <span class="textoInfo">@{{ Cultivo.creditos_colocados }}</span></ul>
					<ul ><label class="texto_title">Cartera Vencida</label> <span class="textoInfo">@{{ Cultivo.cartera_vencida }}</span></ul>
					{{-- @{{Articulo.linea_productiva_id}} --}}
				</div>
				
			</md-card>

			<div flex="" layout layout-wrap class="divMap">
				<div mapa id="map" style="width:800px; height: 400px;overflow: hidden;"></div>
			</div>
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

