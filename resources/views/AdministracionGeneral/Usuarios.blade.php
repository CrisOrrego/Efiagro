<div id="Usuarios" flex layout=column ng-controller="UsuariosCtrl">
    <div class="padding-0-10" layout layout-align="center">
        <div class="md-title">Gestión de Usuarios</div>
        <span flex></span>
        <md-button class="md-raised md-primary" aria-label="Nuevo" ng-click="nuevo()">
            <md-icon md-font-icon="fa-plus fa-lg fa-fw"></md-icon> Agregar
        </md-button>
    </div>

    <div class="padding-0-10" layout flex layout-align="center" >
		<div layout=column class="padding-10-10">
			<md-card layout=column class="no-margin-top mxw230">
				<div class="padding-20" layout=column>
					<label>Filtros de búsqueda</label>

					<md-input-container>
						<label>Documento</label>
						<input ng-change="filterUsuarios()" type="text" ng-model="filterDocumento" placeholder="" ng-model-options="{ debounce: 1000 }" autocomplete="off" enter-stroke="buscador()" aria-label="Palabras clave">
					</md-input-container>

                    <md-input-container>
						<label>Nombres</label>
						<input ng-change="filterUsuarios()" type="text" ng-model="filterNombre" placeholder="" ng-model-options="{ debounce: 1000 }" autocomplete="off" enter-stroke="buscador()" aria-label="Palabras clave">
					</md-input-container>

					<md-input-container>
						<label>Apellidos</label>
						<input ng-change="filterUsuarios()" type="text" ng-model="filterApellido" placeholder="" ng-model-options="{ debounce: 1000 }" autocomplete="off" enter-stroke="buscador()" aria-label="Palabras clave">
					</md-input-container>
				</div>
			</md-card>
		</div>

        <md-card flex class="no-margin-top" >
            <md-table-container>
                <table md-table >
                    <thead md-head >
                    <tr md-row>
                        <th md-column>Editar</th>
                        <th md-column>Clave</th>
                        <th md-column>Fincas</th>
                        <th md-column>TD</th>
                        <th md-column>Documento</th>
                        <th md-column>Nombre</th>
                        <th md-column>Apellido</th>
                        <th md-column>Correo</th>
                        <th md-column>Celular</th>
                        <th md-column>Perfil</th>
                        <th md-column>Organización</th>
                    </tr>
                    </thead>
                    <tbody md-body >
                        <tr md-row ng-repeat="U in Usuarioscopy ">
                            <td md-cell>
                                <md-button class="md-icon-button" ng-click="editarUsuario(U)">
                                    <md-icon md-font-icon="fa-edit"></md-icon>
                                </md-button>
                            </td>
                            <td md-cell>
                                <md-button class="md-icon-button" ng-click="cambiarClave(U)">
                                    <md-icon md-font-icon="fa-key"></md-icon>
                                </md-button>
                            </td>
                            <td md-cell>
                                <md-button class="md-icon-button" ng-click="cargarFincas(U)">
                                    <md-icon md-font-icon="fa-chart-area"></md-icon>
                                </md-button>
                            </td>
                            <td md-cell>@{{ U.tipo_documento }}</td>
                            <td md-cell>@{{ U.documento }}</td>
                            <td md-cell>@{{ U.nombres }}</td>
                            <td md-cell>@{{ U.apellidos }}</td>
                            <td md-cell>@{{ U.correo }}</td>
                            <td md-cell>@{{ U.celular }}</td>
                            <td md-cell>@{{ U.perfil.perfil }}</td>
                            <td md-cell>@{{ U.organizaciones_usuario.nombre }}</td>
                        </tr>
                    </tbody>
                </table>
            </md-table-container>
        </md-card>
    </div>
</div>