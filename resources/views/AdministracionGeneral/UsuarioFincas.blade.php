<md-dialog class="vh95 w100p mxw850" layout=column>
	
	<div layout class="" layout-align="center center">
		<div class="text-clear padding-left" flex>Fincas para el usuario @{{ UsuarioFinca.nombre }} </div>
		<md-button ng-click="Cancel()" class="md-icon-button no-margin">
			<md-icon md-font-icon="fa-times"></md-icon>
		</md-button>
	</div>
    <md-content>
        <md-tabs class="" >
            <md-tab ng-repeat="F in Fincas" label="@{{ F.nombre }}">
                <md-content class="md-padding">
                    <div>
                        <md-input-container>
                            <label>Nombre</label>
                            <input ng-model="F.nombre" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Dirección</label>
                            <input ng-model="F.direccion" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Departamento</label>
                            <md-select ng-model="F.departamento_id" class="no-margin" 
                                aria-label="Organizacion" ng-change="listarMunicipios(F.departamento_id)">
                                <md-option ng-value="D.codigo" ng-repeat="D in Departamentos">@{{ D.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Municipio</label>
                            <md-select ng-model="F.municipio_id" class="no-margin" 
                                aria-label="Organizacion" ng-change="listarMunicipios(F.departamento_id)">
                                <md-option ng-value="M.codigo" ng-repeat="M in Municipios | filter:{op1:F.departamento_id}" >@{{ M.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Area</label>
                            <input ng-model="F.area_total" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Total de lotes</label>
                            <input ng-model="F.total_lotes" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Tipo de cultivo</label>
                            <md-select ng-model="F.tipo_cultivo" class="no-margin" 
                                aria-label="Organizacion" >
                                <md-option ng-value="Tc.codigo" ng-repeat="Tc in TipoCultivo " >@{{ Tc.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Tipo de suelo</label>
                            <md-select ng-model="F.tipo_suelo" class="no-margin" 
                                aria-label="Organizacion" >
                                <md-option ng-value="Ts.codigo" ng-repeat="Ts in TipoSuelo " >@{{ Ts.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Zona</label>
                            <input ng-model="F.zona_id" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Latitud</label>
                            <input ng-model="F.latitud" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Longitud</label>
                            <input ng-model="F.longitud" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Hectareas</label>
                            <input ng-model="F.hectareas" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Sitios</label>
                            <input ng-model="F.sitios" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Temperatura (C°)</label>
                            <input ng-model="F.temperatura" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Humedad Relativa (%)</label>
                            <input ng-model="F.humedad_relativa" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Precipitacion Mn</label>
                            <input ng-model="F.precipitacion" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Altimetría Mínima (Mts)</label>
                            <input ng-model="F.altimetria_min" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Altimetría Máxima (Mts)</label>
                            <input ng-model="F.altimetria_max" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Brillo solar</label>
                            <input ng-model="F.brillo_solar" type="text" />
                        </md-input-container>
                        <md-button class="md-raised md-primary" ng-click="guardarFinca(F)">
                            <md-icon md-font-icon="fa-save"></md-icon>Actualizar
                        </md-button>
                    </div>
                </md-content>
            </md-tab>
            <md-tab label="+">
                <md-content class="md-padding">
                    <div>
                        <md-input-container>
                            <label>Nombre</label>
                            <input ng-model="F.nombre" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Dirección</label>
                            <input ng-model="F.direccion" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Departamento</label>
                            <md-select ng-model="F.departamento_id" class="no-margin" 
                                aria-label="Organizacion" ng-change="listarMunicipios(F.departamento_id)">
                                <md-option ng-value="D.codigo" ng-repeat="D in Departamentos">@{{ D.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Municipio</label>
                            <md-select ng-model="F.municipio_id" class="no-margin" 
                                aria-label="Organizacion" ng-change="listarMunicipios(F.departamento_id)">
                                <md-option ng-value="M.codigo" ng-repeat="M in Municipios | filter:{op1:F.departamento_id}" >@{{ M.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Area</label>
                            <input ng-model="F.area_total" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Total de lotes</label>
                            <input ng-model="F.total_lotes" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Tipo de cultivo</label>
                            <md-select ng-model="F.tipo_cultivo" class="no-margin" 
                                aria-label="Organizacion" >
                                <md-option ng-value="Tc.codigo" ng-repeat="Tc in TipoCultivo " >@{{ Tc.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Tipo de suelo</label>
                            <md-select ng-model="F.tipo_suelo" class="no-margin" 
                                aria-label="Organizacion" >
                                <md-option ng-value="Ts.codigo" ng-repeat="Ts in TipoSuelo " >@{{ Ts.descripcion }}</md-option>
                            </md-select>
                        </md-input-container>
                        <md-input-container>
                            <label>Zona</label>
                            <input ng-model="F.zona_id" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Latitud</label>
                            <input ng-model="F.latitud" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Longitud</label>
                            <input ng-model="F.longitud" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Hectareas</label>
                            <input ng-model="F.hectareas" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Sitios</label>
                            <input ng-model="F.sitios" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Temperatura (C°)</label>
                            <input ng-model="F.temperatura" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Humedad Relativa (%)</label>
                            <input ng-model="F.humedad_relativa" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Precipitacion Mn</label>
                            <input ng-model="F.precipitacion" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Altimetría Mínima (Mts)</label>
                            <input ng-model="F.altimetria_min" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Altimetría Máxima (Mts)</label>
                            <input ng-model="F.altimetria_max" type="text" />
                        </md-input-container>
                        <md-input-container>
                            <label>Brillo solar</label>
                            <input ng-model="F.brillo_solar" type="text" />
                        </md-input-container>
                        <md-button class="md-raised md-primary" ng-click="nuevaFinca(F)">
                            <md-icon md-font-icon="fa-save"></md-icon>Guardar nueva
                        </md-button>
                    </div>
                </md-content>
            </md-tab>
        </md-tabs>
        
    </md-content>
</md-dialog>