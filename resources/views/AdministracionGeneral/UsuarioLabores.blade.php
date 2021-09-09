<md-dialog flex=95 class="vh95 w95p" layout=column id="modallabores">
    <div layout>
        <div class=" padding-top padding-left">
            <label for="">Seleccionar Año</label>
            <md-select aria-label="anioSelected" ng-model="anioSelected" ng-change="cambiarAnio(anioSelected)">
                <md-option ng-repeat="a in anios" ng-value="a"> @{{ a }}  </md-option>
            </md-select>
		</div>
        <div class="text-clear text-center md-title" flex>
            <p>Labores Registradas</p>
            <br>
        </div>
        <md-button ng-click="Cancel()" class="md-icon-button no-margin">
			<md-icon md-font-icon="fa-times"></md-icon>
		</md-button>
    </div>

    <div flex layout>
        <div class="w300" layout=column>
            <md-table-container>
                <table md-table >
                    <thead md-head >
                        <tr md-row>
                            <th md-column >Datos
                                <br>Labores
                            </th>
                            <th md-column style="padding: 3px; margin: 0; width: 10px;">In</th>
                            <th md-column style="padding: 3px; margin: 0; width: 10px;">Fr</th>
                            <th md-column style="padding: 3px; margin: 0; width: 10px;">Ma</th>
                        </tr>
                    </thead>
                    <tbody md-body>
                        <tr md-row ng-repeat="L in InfoLabores">
                            <td md-cell >@{{ L.labor }}</td>
                            <td md-cell style="padding: 3px; margin: 0; width: 10px;">
                                <input type="number" value="@{{ L.inicio }}">
                                </td>
                            <td md-cell style="padding: 3px; margin: 0; width: 20px;">
                                <md-input-container>
                                    <input type="text" value="@{{ L.frecuencia }}">
                                </md-input-container>
                            </td>
                            <td md-cell style="padding: 3px; margin: 0; width: 10px;">@{{ L.margen }}</td>
                        </tr>
                    </tbody>
                </table>
            </md-table-container>
            <md-input-container>
                <label for="">Agregar Labor</label>
                <input type="text" ng-model="nuevaLabor" enter-stroke="agregarLabor()" placeholder="Escriba la nueva labor" />
            </md-input-container>
        </div>
        <div flex>
            <md-table-container>
                <table md-table >
                    <thead md-head >
                        <tr md-row>
                            <th md-column ng-repeat="S in encabezado" style="text-align: center; padding: 3px; margin: 0">@{{ S.semana }}
                                <br>@{{ S.fecha_corta }}
                            </th>
                        </tr>
                    </thead>
                    <tbody md-body>
                        <tr md-row ng-repeat="L in detalle">
                            <td md-cell ng-repeat="S in L" class="@{{ S.tipo }}"></td>
                        </tr>
                    </tbody>
                </table>
            </md-table-container>
        </div>
    </div>
    
    <div layout hide>
        <md-input-container>
            <label>Descripcion de la Labor</label>
            <input ng-model="labornombre" type="text" />
        </md-input-container>
        <md-input-container>
            <label>Inicio</label>
            <input ng-model="laborinicio" type="number" maxlength="52" min="1" />
        </md-input-container>
        <md-input-container>
            <label>Frecuencia</label>
            <input ng-model="laborfrecuencia" type="number" maxlength="52" min="2" />
        </md-input-container>
        <md-input-container>
            <label>Margen</label>
            <input ng-model="labormargen" type="number" maxlength="2" min="0" />
        </md-input-container>
        <md-button class="md-primary" ng-click="guardarLabor()">
            <md-icon md-font-icon="fa-save"></md-icon>Guardar Labor
        </md-button>
    </div>
    <style>
        td.principal {
            background-color: #7BD8F9;
        }
        td.secundaria {
            background-color: #D3F2FD;
        }
        td.establecimiento {
            background-color: #BEFFBC;
        }
        td, th{
            border-right: 1px solid darkgrey;
            border-bottom: 1px solid darkgrey;
            font-size: 9px !important;
            margin: 1px;
        }
        .datolabor{
            padding: 3px; 
            margin: 0;
            width: 10px;
        }
    </style>
</md-dialog>