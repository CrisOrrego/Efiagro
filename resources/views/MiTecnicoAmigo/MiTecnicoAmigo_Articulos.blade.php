<div flex layout=column ng-show="Subseccion == 'Articulos'">

	<div layout layout-align="center center" class="padding-top">
		
		<div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
			<md-input-container flex class="no-margin md-no-underline" md-no-float>
				<!--INICIO DEV ANGÉLICA-->
                <input type="text" ng-model-options="{ debounce: 1000 }" ng-change="searchChange()" ng-model="filtroArticulos" placeholder="Buscar...">
                <!--FIN DEV ANGÉLICA-->
			</md-input-container>
		</div>

	</div>

	<!--INICIO DEV ANGÉLICA-->
	<div flex layout layout-wrap class="overflow-y" layout-align="center start">

		<div ng-repeat="A in Articulos | filter:{encontrado:true}" class="padding" flex=100 flex-gt-xs=50 flex-gt-md=33
			ng-click="abrirArticulo(A)">
			<md-card class="padding no-margin" >
				@{{ A.titulo }} @{{ A.contador }}
			</md-card>
		</div>

	</div>
    <!--FIN DEV ANGÉLICA-->

	<div layout layout-align="center center" ng-click="Subseccion = 'Solicitudes'">
		<md-button class="md-raised md-primary boton-principal">Solicitudes a Técnico Amigo</md-button>
	</div>

</div>