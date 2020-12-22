<div flex layout=column ng-show="Subseccion == 'Articulos'">

	<div layout layout-align="center center" class="padding-top">
		
		<div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
			<md-input-container flex class="no-margin md-no-underline" md-no-float>
				<input type="text" ng-model="filtroArticulos" placeholder="Buscar...">
			</md-input-container>
		</div>

	</div>

	<div flex layout layout-wrap class="overflow-y" layout-align="center start">

		<div ng-repeat="A in Articulos" class="padding" flex=100 flex-gt-xs=50 flex-gt-md=33 
			ng-click="abrirArticulo(A)">
			<md-card class="padding no-margin" >
				@{{ A.titulo }}
			</md-card>
		</div>
		
	</div>

	<div layout layout-align="center center" ng-click="Subseccion = 'Solicitudes'">
		<md-button class="md-raised md-primary boton-principal">Solicitudes a Técnico Amigo</md-button>
	</div>

</div>