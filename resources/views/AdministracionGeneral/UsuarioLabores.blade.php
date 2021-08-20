<md-dialog flex=95 class="vh95 w95p" layout=column id="modallabores">
    <div class="text-clear text-center">
        <p>Labores Registradas</p>
        <br>
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
                            <td md-cell style="padding: 3px; margin: 0; width: 10px;">@{{ L.inicio }}</td>
                            <td md-cell style="padding: 3px; margin: 0; width: 10px;">@{{ L.frecuencia }}</td>
                            <td md-cell style="padding: 3px; margin: 0; width: 10px;">@{{ L.margen }}</td>
                        </tr>
                    </tbody>
                </table>
            </md-table-container>
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
        }
        .datolabor{
            padding: 3px; 
            margin: 0;
            width: 10px;
        }
    </style>
</md-dialog>