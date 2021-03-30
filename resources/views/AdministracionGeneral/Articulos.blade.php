<div id="GestionArticulos" ng-controller="ArticulosCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Repositorio de Conocimiento</div>
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevoArticulo()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Articulo
		</md-button>
	</div>

	<div class="padding-0-10" layout flex layout-align="center" >
		<div layout=column class="padding-10-10">
			<md-card layout=column class="no-margin-top mxw230">
				<div class="padding-20" layout=column>
						
					<label>Filtros de búsqueda</label>
						
					<mat-form-field appearance="fill">
					
					<md-input-container>
						<label>Lineas productivas</label>
							<md-select ng-model="idLineaproductiva" ng-change="filterArticulos()" placeholder="Línea Productiva">
								<md-option ng-value="lp">
									Todos las líneas
								</md-option>
								<md-option ng-repeat="lp in lineas_productivas" ng-value="lp.id">
									@{{lp.nombre}}
								</md-option>
							</mat-select>
						</mat-form-field>
					</md-input-container>

</div>








