<div flex layout=column>
		
	<div layout>
		<a ng-repeat="S in Secciones[Estado.ruta[2]]" href="#/Home/@{{ S.seccion_slug }}/@{{ S.subseccion_slug }}">
			@{{ S.subseccion }}
		</a>
	</div>

	<div id="Subseccion" flex ui-view></div>

</div>