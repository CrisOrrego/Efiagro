<div flex layout=column ng-show="Subseccion == 'Solicitudes'">
	
	<div layout class="margin-top">
		<div flex>
			<md-button class="md-raised">
				<md-icon md-font-icon="fa-arrow-left fa-fw"></md-icon>
				Volver a Articulos
			</md-button>
		</div>
		<md-button class="md-raised md-primary boton-principal" ng-click="crearCaso()">Crear Nueva Solicitud</md-button>
		<div flex></div>
	</div>

	<div layout=column flex layout-align="start center" class="padding">
		
		<md-card ng-repeat="Caso in CasosCRUD.rows" layout=column class="padding w100p mxw600 pointer"
			ng-click="novedadesCaso(Caso)">
			<div layout layout-align="space-between center margin-bottom-5">
				<div>
					<h3 class="md-title no-margin">@{{ Caso.titulo }}</h3>
				</div>
			</div>
			<div class="text-darkgreen text-bold text-14px">
				Ver @{{ Caso.novedades.length }} @{{ Caso.novedades.length == 1 ? 'Respuesta' : 'Respuestas' }}
			</div>
		</md-card>
	</div>

</div>