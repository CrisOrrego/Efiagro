<div id="GestionFincas" ng-controller="FincasCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestion de Fincas</div>
		<span flex></span>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterFincas" placeholder="Buscar...">
		</md-input-container>
		
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevaFinca(F)">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Finca
		</md-button>
	</div>

<md-card flex class="no-margin-top">
			<md-table-container class="border-bottom">
			  <table md-table>
				<thead md-head>
				  <tr md-row>
					<th md-column>ID</th>
					<th md-column>Usuario</th>
					<th md-column>Nombre</th>
					<th md-column>Zona</th>
					<th md-column>Latitud</th>
					<th md-column>Longitud</th>
				    <th md-column>Hectareas</th>
					<th md-column>Sitios</th>
					<th md-column>Acción</th>
				  </tr>
				</thead>
				<tbody md-body>
				  <tr md-row ng-repeat="F in FincasCRUD.rows | filter:filterFincas">
					
                    <td md-cell>@{{ F.id }}</td>
                    <td md-cell>@{{ F.usuario_id }}</td>
					<td md-cell>@{{ F.nombre }}</td>
					<td md-cell>@{{ F.zona_id }}</td>
					<td md-cell>@{{ F.latitud }}</td>
                    <td md-cell>@{{ F.longitud }}</td>
                    <td md-cell>@{{ F.hectareas }}</td>
                    <td md-cell>@{{ F.sitios }}</td>
					{{-- <td md-cell>@{{ O.created_at }}</td> --}}
					{{-- <td md-cell>@{{ O.updated_at }}</td> --}}
					<td md-cell>
						<md-button class="md-icon-button" ng-click="editarFinca(F)">
							<md-icon md-font-icon="fa-edit"></md-icon>
						</md-button>
						<md-button class="md-icon-button md-warn" ng-click="eliminarFinca(F)">
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
