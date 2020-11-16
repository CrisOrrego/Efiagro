<md-dialog class="vh95 w100p mxw550" layout=column>

	<div layout>
		<div flex class="md-title padding-top padding-left">
			@{{ Articulo.titulo }}		
		</div>
		<md-button class="md-icon-button no-margin" aria-label="salir" ng-click="Salir()">
			<md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
		</md-button>
	</div>
	
	<div flex layout=column class="padding-10-20 overflow-y">
	
		<div ng-repeat="S in Articulo.secciones">
			
			<div ng-if="S.tipo == 'Parrafo'" class="margin-bottom text-justify">@{{ S.contenido }}</div>

		</div>	

		<div class="h120">&nbsp;</div>	

	</div>

</md-dialog>