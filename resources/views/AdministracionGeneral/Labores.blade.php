<div id="GestionLabores" ng-controller="LaboresCtrl" flex layout=column>
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title">Gestion de Labores</div>
		<span flex></span>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterLabores" placeholder="Buscar...">
		</md-input-container>
		
		<span flex></span>
		<md-button class="md-raised md-primary" aria-label="Nueva" ng-click="nuevaLabor()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Labor
		</md-button>
	</div>
	<md-card flex class="no-margin-top">
	<md-table-container class="border-bottom">
	  <table md-table>
	    <thead md-head>
	      <tr md-row>
			<th md-column>ID</th>
	        <th md-column>Labor</th>
			<th md-column>Linea Productiva</th>
	        <th md-column>Frecuencia</th>
	        <th md-column>Semana de Inicio</th>
	        <th md-column>Margen</th>
			<th md-column>Acción</th>
	      </tr>
	    </thead>
	    <tbody md-body>
			<tr md-row ng-repeat="L in LaboresCRUD.rows | filter:filterLabores">
			<td md-cell>@{{ L.id }} </td>
	        <td md-cell>@{{ L.labor }}</td>
			<td md-cell>@{{ L.linea_productiva_id }} </td> 
            <td md-cell><span>CADA</span> <b>@{{ L.frecuencia }}</b> <span>SEMANAS</span></td>
            <td md-cell>@{{ L.semana_inicio }}</td>
            <td md-cell><b>@{{ L.margen }}</b> <span>SEMANAS</span></td>
			<td md-cell>
				<md-button class="md-icon-button" ng-click="editarLabor(Labor)">
					<md-icon md-font-icon="fa-edit"></md-icon>
				</md-button>
				<md-button class="md-icon-button md-warn" ng-click="eliminarLabor(L)">
					<md-icon md-font-icon="fa-trash"></md-icon>
				</md-button>
			</td>
	      </tr>
	    </tbody>
	  </table>
	</md-table-container>
	</md-card>

</div>
