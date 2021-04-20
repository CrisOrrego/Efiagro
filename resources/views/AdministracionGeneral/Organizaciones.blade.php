<div id="GestionOrganizaciones" ng-controller="OrganizacionesCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestion de Organizaciones</div>
		<span flex></span>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterOrganizaciones" placeholder="Buscar...">
		</md-input-container>
		
		<span flex></span>
		<!--<md-select ng-change="selectChanged()" ng-model="value">
			<md-option value="1">Algo</md-option>
			<md-option value="2">Algo 2</md-option>
			<md-option value="3">Algo 3</md-option>
		</md-select>-->
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevaOrganizacion()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Organización
		</md-button>
	</div>

	<md-card flex class="no-margin-top">
		<md-table-container class="border-bottom">
			<table md-table>
			<thead md-head>
				<tr md-row>
				<th md-column>ID</th>
				<th md-column>Nombre</th>
				<th md-column>NIT</th>
				{{-- <th md-column>Sigla</th> --}}
				<th md-column>Dirección</th>
				{{-- <th md-column>Departamento</th> --}}
				{{-- <th md-column>Municipio</th> --}}
				<th md-column>Telefono</th>
				<th md-column>Correo</th>
				{{-- <th md-column>Total Asociados</th> --}}
				{{-- <th md-column>Fecha de constitución</th> --}}
				{{-- <th md-column>Creada</th> --}}
				{{-- <th md-column>Actualizada</th> --}}
				<th md-column>Acción</th>
				</tr>
			</thead>
			<tbody md-body>
				<tr md-row ng-repeat="O in OrganizacionesCRUD.rows | filter:filterOrganizaciones">
				
				<td md-cell>@{{ O.id }}</td>
				<td md-cell>@{{ O.nombre }}</td>
				<td md-cell>@{{ O.nit }}</td>
				{{-- <td md-cell>@{{ O.sigla }}</td> --}}
				<td md-cell>@{{ O.direccion }}</td>
				{{-- <td md-cell>@{{ O.departamento }}</td> --}}
				{{-- <td md-cell>@{{ O.municipio }}</td> --}}
				<td md-cell>@{{ O.telefono }}</td>
				<td md-cell>@{{ O.correo }}</td>
				{{-- <td md-cell>@{{ O.total_asociados }}</td> --}}
				{{-- <td md-cell>@{{ O.fecha_constitucion }}</td> --}}
				{{-- <td md-cell>@{{ O.created_at }}</td> --}}
				{{-- <td md-cell>@{{ O.updated_at }}</td> --}}
				<td md-cell>
					<md-button class="md-icon-button" ng-click="editarOrganizacion(O)">
						<md-icon md-font-icon="fa-edit"></md-icon>
					</md-button>
					<md-button class="md-icon-button md-warn" ng-click="eliminarOrganizacion(O)">
						<md-icon md-font-icon="fa-trash"></md-icon>
					</md-button>
				</td>
				</tr>
			</tbody>
			</table>
		</md-table-container>
	</md-card>
</div>
