<div id="GestionLotes" ng-controller="LotesCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestion de Lotes</div>
		<span flex></span>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterLotes" placeholder="Buscar...">
		</md-input-container>
		
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevoLote(L)">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Lote
		</md-button>
	</div>
{{-- Lotes --}}
<md-card flex class="no-margin-top">
			<md-table-container class="border-bottom">
			  <table md-table>
				<thead md-head>
				  <tr md-row>
					{{-- <th md-column>ID</th> --}}
					<th md-column>Finca</th>
					<th md-column>Organización</th>
					<th md-column>Linea Productiva</th>
					<th md-column>Labores</th>
					<th md-column>Hectareas</th>
					<th md-column>Sitios</th>
					<th md-column>Acción</th>
				  </tr>
				  
				</thead>
				<tbody md-body>
				  <tr md-row ng-repeat="L in LotesCRUD.rows | filter:filterLotes">
                    {{-- <td md-cell>@{{ L.id }}</td> --}}
                    <td md-cell>@{{ L.finca.nombre }}</td>
					<td md-cell>@{{ L.organizacion.nombre }}</td>
					<td md-cell>@{{ L.linea_productiva.nombre }}</td>
					<td md-cell>@{{ L.labor.labor }}</td>
					<td md-cell>@{{ L.hectareas }} <span>Hectareas</span></td>
                    <td md-cell>@{{ L.sitios }} <span>Sitios</span></td>
					{{-- <td md-cell>@{{ O.created_at }}</td> --}}
					{{-- <td md-cell>@{{ O.updated_at }}</td> --}}
					<td md-cell>
						<md-button class="md-icon-button" ng-click="editarLote(L)">
							<md-icon md-font-icon="fa-edit"></md-icon>
						</md-button>
						<md-button class="md-icon-button md-warn" ng-click="eliminarLote(L)">
							<md-icon md-font-icon="fa-trash"></md-icon>
						</md-button>
					</td>
				  </tr>
				</tbody>
			  </table>
			</md-table-container>
			</md-card>
	</md-card>
</div>

</div>
