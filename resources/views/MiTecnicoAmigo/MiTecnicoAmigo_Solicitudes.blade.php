<div flex layout=column ng-show="Subseccion == 'Solicitudes'">
	
	<div layout layout-align="center center" class="margin-top">
		<md-button class="md-raised md-primary boton-principal" ng-click="crearCaso()">Crear Nueva Solicitud</md-button>
	</div>

	
	<div layout=column flex layout-align="start center" class="padding">
		
		<md-card ng-repeat="Caso in CasosCRUD.rows" layout=column class="padding w100p mxw600">
			<div layout layout-align="space-between center">
				<div>
					<h3 class="md-title no-margin">@{{ Caso.titulo }}</h3>
				</div>
				<div>
					<md-icon md-font-icon="fa-edit fa-lg" ng-click="novedadesCaso(Caso)" class="fa fa-edit fa-lg" role="img" aria-label="fa-edit fa-lg"></md-icon>
				</div>
			</div>
			<div class="text-clear text-14px">@{{ Caso.tipo }}</div>
		</md-card>
	</div>

	<div layout layout-align="center center" ng-click="Subseccion = 'Articulos'">
		<md-button class="md-raised md-primary boton-principal">Ver Articulos</md-button>
	</div>

</div>