<div id="GestionZonas" ng-controller="ZonasCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestion de Zonas</div>
		<span flex></span>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterZonas" placeholder="Buscar...">
		</md-input-container>
		
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevaZona()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Zona Agroambiental
		</md-button>
	</div>

<md-card flex class="no-margin-top">
			<md-table-container class="border-bottom">
			  <table md-table>
				<thead md-head>
				  <tr md-row>
					{{-- <th md-column>ID</th> --}}
					<th md-column>Descripción</th>
					<th md-column>Linea Productiva</th>
					<th md-column>Temperatura Min </th>
					<th md-column>Temperatura Max </th>
					<th md-column>Humedad Relativa Min </th>
					<th md-column>Humedad Relativa Max</th>
					<th md-column>Precipitación Min</th>
					<th md-column>Precipitación Max</th>
					<th md-column>Altimetria Min </th>
					<th md-column>Altimetria Max</th>
					<th md-column>Brillo Solar Min</th>
					<th md-column>Brillo Solar Max</th>
					<th md-column>Pendiente</th>
					<th md-column>Acción</th>
				  </tr>
				</thead>
				<tbody md-body>
				  <tr md-row ng-repeat="Z in ZonasCRUD.rows | filter:filterZonas">
					
					{{-- <td md-cell>@{{ Z.id }} </td> --}}
					<td md-cell>@{{ Z.descripcion }}</td>
					<td md-cell>@{{ Z.linea_productiva.nombre }}</td>
					<td md-cell>@{{ Z.temperatura_min }} <span>C°</span></td>
					<td md-cell>@{{ Z.temperatura_max }} <span>C°</span></td>
					<td md-cell>@{{ Z.humedad_relativa_min }} <span>%</span></td>
					<td md-cell>@{{ Z.humedad_relativa_max }} <span>%</span></td>
					<td md-cell>@{{ Z.precipitacion_min }} <span>Mm</span></td>
					<td md-cell>@{{ Z.precipitacion_max }} <span>Mm</span></td>
					<td md-cell>@{{ Z.altimetria_min }} <span>Mt</span></td>
					<td md-cell>@{{ Z.altimetria_max }} <span>Mt</span></td>
					<td md-cell>@{{ Z.brillo_solar_min }} <span>H</span></td>
					<td md-cell>@{{ Z.brillo_solar_max }} <span>H</span></td>
					<td md-cell>@{{ Z.pendiente }} <span>H</span></td>

					<td md-cell>
						<md-button class="md-icon-button" ng-click="editarZona(Z)">
							<md-icon md-font-icon="fa-edit"></md-icon>
						</md-button>
						<md-button class="md-icon-button md-warn" ng-click="eliminarZona(Z)">
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
