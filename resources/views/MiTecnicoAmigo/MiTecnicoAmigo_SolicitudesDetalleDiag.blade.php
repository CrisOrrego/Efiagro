<md-dialog class="vh95 mxw850 overflow-x" layout=column>

	<div class="md-toolbar-tools">
        <h2>Caso # @{{ Caso.id }}</h2>
        <span flex="" class="flex"></span>
        <md-button ng-click="Cancel()" class="md-icon-button no-margin text-red">
			<md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
			<md-tooltip md-direction="bottom">Cerrar modal</md-tooltip>
		</md-button>
	</div>
	<div class="text-clear padding-0-20" flex>@{{ Caso.tipo }} ( Luigi OsoQui )</div>
	<h3 class="padding-0-20">@{{ Caso.titulo }}</h3>

	<div layout=column flex class="overflow-y padding-0-20">
		<h4 class="text-center">Novedades del Caso</h4>
		<div ng-repeat="N in NovedadesCRUD.rows" class="footnote">
			<p>
				@{{ N.created_at | date:'longDate' }} - Nombre Usuario <br/>
				@{{ N.novedad }}
			</p>
		</div>
	</div>
	
	<div layout class=" padding-5-10" layout-align="space-between start">
		<md-input-container class="no-margin md-title w80p" >
			<textarea ng-model="detallecaso" placeholder="Registrar la novedad" rows="3"></textarea>
		</md-input-container>
		<md-button class="md-raised md-primary no-margin" ng-click="crearNovedad('Texto', detallecaso)">
			Agregar
		</md-button>
	</div>
</md-dialog>