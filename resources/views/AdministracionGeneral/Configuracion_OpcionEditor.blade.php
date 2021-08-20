<div ng-if="Op.tipo == 'Texto'">
    <md-input-container>
        <input type=email ng-model="Op.valor" ng-change="Op.changed = true" />
    </md-input-container>
</div>
<div ng-if="Op.tipo == 'Numero'">
    <md-input-container>
        <input type=texto ng-model="Op.valor" ng-change="actualizarOpcion('Numero', Op.valor)" />
    </md-input-container>
</div>
<div ng-if="Op.tipo == 'Boolean'">
    <md-switch type=boolean ng-model="boolean"></md-switch>
</div>
