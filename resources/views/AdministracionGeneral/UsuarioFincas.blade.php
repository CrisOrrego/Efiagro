<md-dialog class="vh95 w100p " >
	
	<div layout class="" layout-align="center center">
		<div class="text-clear padding-left" flex>Fincas para el usuario @{{ UsuarioFinca.nombre }} </div>
		<md-button ng-click="Cancel()" class="md-icon-button no-margin">
			<md-icon md-font-icon="fa-times"></md-icon>
		</md-button>
	</div>
    
    <md-tabs class="" >
        <md-tab ng-repeat="F in Fincas" ng-click="cargarLotes(F)">@{{ F.nombre }}</md-tab>
        <md-tab ng-click="formularioNuevaFinca()" label="+"></md-tab>
    </md-tabs>

    <div layout layout-wrap >
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
            <input ng-model="F.temperatura" type="text" ng-change="recalcularZona(F)" />
        </md-input-container>
        <md-input-container>
            <label>Humedad Relativa (%)</label>
            <input ng-model="F.humedad_relativa" type="text" ng-change="recalcularZona(F)" />
        </md-input-container>
        <md-input-container>
            <label>Precipitacion Mn</label>
            <input ng-model="F.precipitacion" type="text" ng-change="recalcularZona(F)" />
        </md-input-container>
        <md-input-container>
            <label>Altimetría (Mts)</label>
            <input ng-model="F.altimetria" type="text" ng-change="recalcularZona(F)" />
        </md-input-container>
        <md-input-container>
            <label>Pendiente (Mts)</label>
            <input ng-model="F.pendiente" type="text" ng-change="recalcularZona(F)" />
        </md-input-container>
        <md-input-container>
            <label>Brillo solar</label>
            <input ng-model="F.brillo_solar" type="text" ng-change="recalcularZona(F)" />
        </md-input-container>
        <md-button ng-show="F.id > 0" class="md-raised md-primary" ng-click="guardarFinca(F)">
            <md-icon md-font-icon="fa-save"></md-icon> Actualizar
        </md-button>
        <md-button ng-show="!F.id" class="md-raised md-primary" ng-click="nuevaFinca(F)">
            <md-icon md-font-icon="fa-save"></md-icon> Nuevo
        </md-button>
    </div>

    <div ng-show="F.id > 0">
        <div class="text-clear padding" >Lotes de la finca</div>
        
        <md-tabs class="" >
            <md-tab ng-show="L" ng-repeat="L in Lotes" label="Lote @{{ $index + 1 }}" 
                ng-click="cargarLote(L)"></md-tab>
            <md-tab ng-click="" label="+"></md-tab>
        </md-tabs>

        <div layout layout-wrap ng-show="L">
            <md-input-container>
                <label>Linea Productiva</label>
                <md-select ng-model="L.linea_productiva_id" class="no-margin" style="min-width: 150px;"
                    aria-label="linea_productiva_id">
                    <md-option ng-value="LP.id" ng-repeat="LP in Lineasproductivas">@{{ LP.nombre }}</md-option>
                </md-select>
            </md-input-container>
            <md-input-container>
                <label>Labores</label>
                <md-select ng-model="L.labores_id" class="no-margin" 
                    aria-label="Labores" >
                    <md-option ng-value="La.id" ng-repeat="La in Labores">@{{ La.labor }}</md-option>
                </md-select>
            </md-input-container>
            <md-input-container>
                <label>Hectareas</label>
                <input ng-model="L.hectareas" type="text" />
            </md-input-container>
            <md-input-container>
                <label>Sitios</label>
                <input ng-model="L.sitios" type="text" />
            </md-input-container>
            <md-input-container>
                <label>Coordenadas</label>
                <input ng-model="L.coordenadas" type="text" />
            </md-input-container>
            <md-input-container>
                <label>Fec. Establecimiento</label>
                <md-datepicker ng-model="L.fecha_establecimiento" ></md-datepicker>
            </md-input-container>
            <md-input-container>
                <label>KG P_promedio</label>
                <input ng-model="L.kg_promedio" type="text" />
            </md-input-container>
            <md-input-container>
                <label>UND. Promedio</label>
                <input ng-model="L.un_promedio" type="text" />
            </md-input-container>
            <md-input-container>
                <label>Frec. Corte</label>
                <input ng-model="L.frec_corte" type="text" />
            </md-input-container>
            <md-button class="md-raised md-primary" ng-click="guardarLote(L, L.LP)">
                <md-icon md-font-icon="fa-save"></md-icon>Guardar Lote @{{ $index + 1 }}
            </md-button>
        </div>

        <div ng-show="L">
            <div class="text-clear padding" ng-model="zp" >@{{ zp }}</div>
            <div>
                <md-button class="md-raised md-primary" ng-click="personalizarLabores()">
                    <md-icon md-font-icon="fa-save"></md-icon>Personalizar Labores
                </md-button>
            </div>
        </div>
    </div>
</md-dialog>
