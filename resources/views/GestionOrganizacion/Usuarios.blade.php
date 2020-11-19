<div id="GestionUsuarios" flex layout=column ng-controller="UsuariosCtrl">
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestión de Usuarios</div>
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevoUsuario()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar
		</md-button>
	</div>

	<md-card flex class="no-margin-top">
	<md-table-container>
	  <table md-table>
	    <thead md-head>
	      <tr md-row>
	        <th md-column></th>
	        <th md-column>Nombres</th>
	        <th md-column>Apellidos</th>
	        <th md-column>Cédula</th>
	        <th md-column>Correo</th>
	      </tr>
	    </thead>
	    <tbody md-body>
	      <tr md-row ng-repeat="U in UsuariosCRUD.rows">
	        <td md-cell><md-button class="md-icon-button" ng-click="editarUsuario(U)">
	        	<md-icon md-font-icon="fa-edit"></md-icon>
	        </md-button></td>
	        <td md-cell>@{{ U.nombres }}</td>
	        <td md-cell>@{{ U.apellidos }}</td>
	        <td md-cell>@{{ U.cedula }}</td>
	        <td md-cell>@{{ U.correo }}</td>
	      </tr>
	    </tbody>
	  </table>
	</md-table-container>
	</md-card>

</div>