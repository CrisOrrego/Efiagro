<div id="GestionLotes" flex layout=column ng-controller="LotesCtrl">
	
	<div layout class="padding-0-10" layout-align="center center">
		<div class="md-title margin-right-20">Gestión de Lotes</div>
		<md-input-container class="no-margin md-icon-float" md-no-float>
			<md-icon md-font-icon="fa-search fa-fw"></md-icon>
			<input type="text" ng-model="filterLotes" placeholder="Buscar...">
		</md-input-container>
		<span flex></span>
	</div>

	<md-card flex class="no-margin-top">
		<md-table-container class="border-bottom">
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
				<tr md-row ng-repeat="L in LotesCRUD.rows | filter:filterLotes ">
					<td md-cell><md-button class="md-icon-button" ng-click="editarLote(U)">
						<md-icon md-font-icon="fa-edit"></md-icon>
					</md-button></td>
					<td md-cell>@{{ U.nombres }}</td>
					<td md-cell>@{{ U.apellidos }}</td>
					<td md-cell>@{{ U.documento }}</td>
					<td md-cell>@{{ U.correo }}</td>
				</tr>
				</tbody>
			</table>
		</md-table-container>
	</md-card>

</div>

<style type="text/css">
   
    .encabezado {
        border-radius: 1rem;
    }

    .seccion_lotes {
        transform: scale(0.95);
        transition: all 0.3s;
    }

    .seccion_lotes:hover {
        transform: scale(1);
    }

    .seccion_lotes {
        width: 600px;
        padding: 10px;
        min-height: 0%;
        background-color: rgb(255, 248, 240);
    }

    md-tabs {
        /* background-image: url("/../imgs/finca.jpg"); */
        background-repeat: no-repeat;
        background-size: cover;

    }

    .texto_title {
        color: rgb(167, 161, 161);
    }

    .img-lote {
        width: 50px;
        height: 50px;
        /* border-radius: 500px; */
    }

</style>
