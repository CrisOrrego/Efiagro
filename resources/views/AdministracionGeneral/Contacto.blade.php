<!--INICIO DEV ANGELICA-->
<div id="GestionContacto" ng-controller="ContactoCtrl" flex layout=column>

<br>
<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title margin-right-20">Control de Contacto</div>
        <span flex></span>
        <md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevoContacto()">
			<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Agregar Contacto
		</md-button>

	</div>
    <br>
	<md-card flex class="no-margin-top">
	<md-table-container class="border-bottom">
	  <table md-table>
	    <thead md-head>
	      <tr md-row>
	        <th md-column></th>
	        <th md-column>Caso</th>
	        <th md-column>Asociado</th>
	        <th md-column>Tipo</th>
	        <th md-column>Titulo</th>
	        <th md-column>Creado</th>
	        <th md-column>Actualizado</th>
	      </tr>
	    </thead>
	    <tbody md-body>
	      <tr md-row ng-repeat="C in ContactoCRUD.rows">
	        <td md-cell>
	        	<md-button class="md-icon-button" ng-click="editarContacto(C)">
		        	<md-icon md-font-icon="fa-edit"></md-icon>
		        </md-button>
		        <md-button class="md-icon-button md-warn" ng-click="eliminarContacto(C)">
		        	<md-icon md-font-icon="fa-trash"></md-icon>
		        </md-button>
	    	</td>
	        <td md-cell>@{{ C.id }}</td>
            <td md-cell>@{{ C.solicitante.nombre }}</td>
            <td md-cell>@{{ C.tipo }}</td>
            <td md-cell>@{{ C.titulo }}</td>
	        <td md-cell>@{{ C.created_at }}</td>
	        <td md-cell>@{{ C.updated_at }}</td>
	      </tr>
	    </tbody>
	  </table>
	</md-table-container>
	</md-card>


    Hello
</div>

<!--FIN DEV ANGELICA-->