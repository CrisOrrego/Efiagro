<div flex layout=column ng-show="Subseccion == 'Articulos'">

	<div layout layout-align="center center" class="padding-top">
		
		<div layout class="w100p mxw600 bg-white padding-5-20 border-rounded">
			<md-input-container flex class="no-margin md-no-underline" md-no-float>
				<!--INICIO DEV ANGÉLICA-->
                <input type="text" ng-model-options="{ debounce: 1000 }" ng-change="searchChange()" ng-model="filtroArticulos" placeholder="Buscar..." autocomplete="off" enter-stroke="searchChange()">
                <!--FIN DEV ANGÉLICA-->
			</md-input-container>
		</div>

	</div>

	<!--INICIO DEV ANGÉLICA-->
	<!--Se muestra la lista de palabras clave en la vista-->
	<br>
	<div class="padding-0-10" layout layout-align="left" >
        <md-card flex class="no-margin-top mxw200">			
			<ul>
			<li ng-repeat="A in PalabrasClave" class="padding" flex=100 flex-gt-xs=50 flex-gt-md=33 ng-click="searchKeyWords(A)">
			@{{A}}
			</li>
			</ul>
        </md-card>

		<div flex layout layout-wrap class="overflow-y" layout-align="center start" ng-show="!Buscando">
			<div ng-repeat="A in Articulos" class="padding" flex=100 flex-gt-xs=50 flex-gt-md=33
			ng-click="abrirArticulo(A)">
			<md-card class="padding no-margin" layout=column>
				<div class="md-title margin-bottom-5" md-truncate>@{{ A.titulo }}</div>
				<div class="md-subheader">Por @{{ A.autor.nombre }}</div>
			</md-card>
		</div>

	</div>

	</div>




	<div flex layout layout-wrap class="overflow-y" layout-align="center start" ng-show="Buscando">

		<div ng-repeat="A in ArticulosBuscados" class="padding" flex=100 flex-gt-xs=50 flex-gt-md=33
			ng-click="abrirArticulo(A)">
			<md-card class="padding no-margin">
				<div md-highlight-text="filtroArticulos" md-highlight-flags="i">@{{ A.titulo }}</div>
			</md-card>
		</div>

	</div>
    <!--FIN DEV ANGÉLICA-->

	<md-button class="md-raised md-primary boton-principal abs" ng-click="Subseccion = 'Solicitudes'"
		style="bottom: 10px; left: 50%; margin-left: -145px">
		Solicitudes a Técnico Amigo
	</md-button>

</div>	