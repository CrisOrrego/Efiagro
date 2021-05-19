<div id="GestionEventos" ng-controller="EventosCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestion de Eventos</div>
		<span flex></span>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterLotes" placeholder="Buscar...">
		</md-input-container>
		
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevoEvento(E)">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Evento
		</md-button>
	</div>
{{-- Lotes --}}
<md-card flex class="no-margin-top">
			<md-table-container class="border-bottom">
			  <table md-table>
				<thead md-head>
				  <tr md-row>
					{{-- <th md-column>ID</th> --}}
					<th md-column>Evento</th>
					<th md-column>Acción</th>
				  </tr>
				  
				</thead>
				<tbody md-body>
				  <tr md-row ng-repeat="E in EventosCRUD.rows | filter:filterEventos">
                    {{-- <td md-cell>@{{ L.id }}</td> --}}
                    <td md-cell>@{{ E.evento }}</td>
					
					<td md-cell>
						<md-button class="md-icon-button" ng-click="editarEvento(E)">
							<md-icon md-font-icon="fa-edit"></md-icon>
						</md-button>
						<md-button class="md-icon-button md-warn" ng-click="eliminarEvento(E)">
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
