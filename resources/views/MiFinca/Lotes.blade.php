<div id="GestionLotes" flex layout=column ng-controller="LotesCtrl">
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title margin-right-20">Gestión de Lotes</div>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterLotes" placeholder="Buscar...">
		</md-input-container>
		<span flex></span>
	</div>

	
	<div id="content">
		<div id="totalSales" ng-repeat="L in LotesCRUD.rows | filter:filterLotes">
			<div class="col">	
				<ul><label>Finca: @{{ L.finca.nombre }}</label></ul>
				<ul><label>Organización: @{{ L.organizacion.nombre }}</label></ul>	
				<ul><label>Linea Productiva: @{{ L.linea_productiva.nombre }}</label></ul>
				<ul><label>Labores: @{{ L.labor.labor }}</label></ul>
				<ul><label>Hectareas: @{{ L.hectareas }} <span>Hectareas</span></label></ul>
				<ul><label>Sitios: @{{ L.sitios }} <span>Sitios</span></label></ul>
				<ul>{{-- <label>Coordenadas: </label> --}}</ul>
			</div>	
		</div>
	</div>
</div>

<style type="text/css">

		#content {
				/* width: calc(100% - 240px);
				height: 900px;
				display: table-cell; */
				
		}
		#totalSales .col {
				float: left;
				margin:20px;
				}
		.col{
			height: 350px;
			width: 400px;
			box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
			/* padding: 5px; */
			
			background: #fbffff;  
			transform: scale(0.95);
			transition: all 0.3s;   
			}
		.col:hover {
				transform: scale(1);
			}
   
		.texto_title {
			color: rgb(167, 161, 161);
		}
		#ul{
			margin: 0%;
			padding: 0%;
		}

		.img-lote {
			width: 50px;
			height: 50px;
			/* border-radius: 500px; */
		}

</style>
