<md-dialog class="vh95 w100p mxw850" layout=column>
    
	<div layout layout-align="center center" class="margin-top">
		<div class="text-clear padding-left" flex>
			<h1>@{{ Caso.id }} - @{{ Caso.titulo }}</h1>
		</div>

		
		<md-button ng-click="Cancel()" class="md-icon-button no-margin text-red">
			<md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
			<md-tooltip md-direction="bottom">Cerrar modal</md-tooltip>
		</md-button>
	</div>

	<div layout=column flex class="">
		<div layout class="padding-0-5">
			<md-input-container class="no-margin md-title" md-no-float flex>
				<input type="text" ng-model="Caso.titulo" placeholder="Titulo" 
					ng-change="guardarCaso()" ng-model-options="{ debounce: 3000 }">
			</md-input-container>
		</div>
		<div class="text-clear padding-left" flex>Caso de Tipo: @{{ Caso.tipo }}</div>
		<hr>
		<h4 class="text-center">Novedades del Caso</h4>
	</div>
	<hr>

	<div flex layout=column >
		<div ng-repeat="N in NovedadesCRUD.rows" class="padding-5">
		<p>@{{ N.novedad }}</p>
			
			<p>&nbsp;</p>
		</div>
	</div>
	
	<md-button ng-click="crearNovedad('Texto')" class="md-icon-button no-margin text-green">
		<md-icon md-font-icon="fa-align-justify fa-lg fa-fw"></md-icon>
		<md-tooltip md-direction="bottom">Agregar texto</md-tooltip>
	</md-button>
	<md-button ng-click="crearNovedad('Imagen')" class="md-icon-button no-margin text-green">
		<md-icon md-font-icon="fa-image fa-lg fa-fw"></md-icon>
		<md-tooltip md-direction="bottom">Agregar Imagen</md-tooltip>
	</md-button>

</md-dialog>