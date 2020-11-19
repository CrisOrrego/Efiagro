<div flex layout=column>
	
	<md-button class="md-icon-button abs no-margin s30 no-padding" style="top: 8px;left: 0;"
		href="#/Home">
		<md-icon md-font-icon="fa-chevron-left fa-lg fa-fw text-primary"></md-icon>
	</md-button>

	<div layout class="bg-primary md-short" md-theme="Transparent" ng-show="Secciones[Estado.ruta[2]].length > 1">

		<md-tabs flex >
			<md-tab ng-repeat="S in Secciones[Estado.ruta[2]]" label="@{{ S.subseccion }}"
				md-active="(S.subseccion_slug == Estado.ruta[3])"
				ng-click="navegarSubseccion(S.seccion_slug, S.subseccion_slug)"></md-tab>
		</md-tabs>


	</div>

	<div id="Subseccion" flex layout ui-view></div>

</div>