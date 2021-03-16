<!--INICIO DEV ANGELICA-->
<div id="GestionConfiguracion" ng-controller="ConfiguracionCtrl" flex layout=column>

	<br>
		<div layout class="padding-0-10" layout-align="center center">
				<div class="md-title margin-right-20">Configuración</div>
					<span flex></span>
	
				</div>
				<br>
				<div layout layout-align="center center" class="padding-top">
					<md-card layout-align class="w100p mxw600 bg-white padding-5-20 border-rounded">
						<md-table-container class="border-bottom">
	
							<div class="md-title margin-right-20">
								Listas
							</div>
							<table md-table>
								<thead md-head>
									<tr md-row>
										<th md-column></th>
										<th md-column>Lista</th>
										<th md-column>Autoincremental</th>
									</tr>
								</thead>
								<tbody md-body>
									<tr md-row ng-repeat="C in ListaCRUD.rows">
										<td md-cell>
											<md-button class="md-icon-button" ng-click="editarLista(C)">
												<md-icon md-font-icon="fa-edit"></md-icon>
											</md-button>
											<md-button class="md-icon-button md-warn" ng-click="eliminarLista(C)">
												<md-icon md-font-icon="fa-trash"></md-icon>
											</md-button>
										</td>
										<td md-cell>@{{ C.id }}</td>
										<td md-cell>@{{ C.lista }}</td>
										<td md-cell>@{{ C.autoincremental }}</td>
									</tr>
								</tbody>
							</table>
						</md-table-container>
						<div class="no-margin">
							<md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevaLista()">
									<md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon>Nueva
							</md-button>
						</div>
					</md-card>
				</div>
	</div>
	
	<!--FIN DEV ANGELICA-->