<md-dialog class="vh95 w100p mxw550" layout=column>
	
	<div layout class="" layout-align="center center">
		<div class="text-clear padding-left" flex>Edición de Articulo</div>
		<md-button ng-click="Cancel()" class="md-icon-button no-margin">
			<md-icon md-font-icon="fa-times"></md-icon>
		</md-button>
	</div>

	<div layout=column flex class="overflow-y">
		<div layout class="padding-0-10">

			<md-input-container class="no-margin md-title" md-no-float flex>
				<input type="text" ng-model="Articulo.titulo" placeholder="Titulo">
			</md-input-container>
		</div>

		<div flex layout=column>
			
			<div ng-repeat="S in SeccionesCRUD.rows" class="padding" layout=column ng-class="{ 'bg-yellow': S.changed }">
				
				<md-input-container class="no-margin" ng-if="S.tipo == 'Parrafo'" md-no-float>
		          <textarea ng-model="S.contenido" rows="5" placeholder="Contenido" ng-change="S.changed = true"></textarea>
		        </md-input-container>

			</div>


			<div layout layout-align="center center">
				<md-button ng-repeat="(kT, T) in TiposSeccion" class="md-raised md-icon-button" 
					ng-click="crearSeccion(kT)" >
					<md-icon md-font-icon="@{{ T.Icono }} fa-lg fa-fw"></md-icon>
					<md-tooltip md-direction="bottom">Agregar @{{ T.Nombre }}</md-tooltip>
				</md-button>
			</div>

			<div class="h100">.</div>

		</div>
	</div>



	<div layout class="border-top">
		<span flex></span>
		<md-button class="md-raised md-primary" ng-click="guardarArticulo()">
			<md-icon md-font-icon="fa-save"></md-icon>Guardar
		</md-button>
	</div>

</md-dialog>