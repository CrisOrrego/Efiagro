<div id="GestionArticulos" ng-controller="ArticulosCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Repositorio de Conocimiento</div>
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevoArticulo()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar Articulo
		</md-button>
	</div>

	<md-card flex class="no-margin-top">
	<md-table-container class="border-bottom">
	  <table md-table>
	    <thead md-head>
	      <tr md-row>
	        <th md-column></th>
	        <th md-column>Titulo</th>
	        <th md-column>Autor</th>
	        <th md-column>Creado</th>
	        <th md-column>Actualizado</th>
	      </tr>
	    </thead>
	    <tbody md-body>
	      <tr md-row ng-repeat="A in ArticulosCRUD.rows">
	        <td md-cell><md-button class="md-icon-button" ng-click="editarArticulo(A)">
	        	<md-icon md-font-icon="fa-edit"></md-icon>
	        </md-button></td>
	        <td md-cell>@{{ A.titulo }}</td>
	        <td md-cell>@{{ A.autor.nombre }}</td>
	        <td md-cell>@{{ A.created_at }}</td>
	        <td md-cell>@{{ A.updated_at }}</td>
	      </tr>
	    </tbody>
	  </table>
	</md-table-container>
	</md-card>

</div>