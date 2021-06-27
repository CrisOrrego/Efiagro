<md-dialog class="vh95 mxw850 mw650 overflow-x bg-dark" layout=column>

	<div layout="row" layout-align="space-between start">
		<div layout="column" layout-align="start" class="padding-20">
			<div layout layout-align="space-between center ">
				<div>
					<h3 class="md-title no-margin">Caso # @{{ Caso.id }}</h3>
				</div>
			</div>
			<div class="text-bold text-14px">
				@{{ Caso.tipo }} ( @{{ Caso.solicitante.nombre }} )
			</div>
		</div>
		<md-button ng-click="Cancel()" class="md-icon-button no-margin text-red">
			<md-icon md-font-icon="fa-times fa-lg fa-fw"></md-icon>
			<md-tooltip md-direction="bottom">Cerrar modal</md-tooltip>
		</md-button>
	</div>
	<h3 class="md-title padding-0-20">@{{ Caso.titulo }}</h3>
	
	<div layout=column flex class="overflow-y padding-0-20">
		<div ng-repeat="N in NovedadesCRUD.rows" class="footnote" >
			<div class="bg-light-grey" style="border-radius: 5px; padding: 5px;">
				<p class="md-title">@{{ N.created_at | date:'longDate' }} ** - @{{ N.autor.nombres }} @{{ N.autor.apellidos }} </p>
				<div ng-if="N.tipo == 'Texto'">
					<p>@{{ N.novedad }}</p>
				</div>
				<div ng-if="N.tipo == 'Imagen'"  class="text-center">
					<img ng-src="@{{ N.novedad }}" alt="">
				</div>
			</div>
			<p></p>
		</div>
	</div>
	
	<div layout class=" padding-5-10" layout-align="space-between start">
		<md-input-container class="no-margin md-title mw650 w80p" >
			<textarea id="casnovedad" ng-model="detallecaso" placeholder="Registrar la novedad" rows="3"></textarea>
		</md-input-container>
		<div layout="column" layout-align=" center">
			<md-button class="md-raised md-primary no-margin" ng-click="crearNovedad('Texto', detallecaso)">
				Agregar
			</md-button>
			<md-button ng-click="crearNovedad('Imagen', detallecaso)">
				<md-icon md-font-icon="fa-image fa-lg fa-fw"></md-icon>
				<md-tooltip md-direction="bottom">Agregar imagen</md-tooltip>
			</md-button>
		</div>
	</div>
</md-dialog>