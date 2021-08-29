<div ng-if="Op.tipo == 'Texto'">
    <md-input-container>
        <input type=text ng-model="Op.valor" ng-change="Op.changed = true" />
    </md-input-container>
</div>
<div ng-if="Op.tipo == 'Numero'">
    <md-input-container>
        <input type=texto ng-model="Op.valor" ng-change="Op.changed = true" />
    </md-input-container>
</div>
<div ng-if="Op.tipo == 'Boolean'">
    <md-checkbox ng-model="Op.valor" ng-change="Op.changed = true">
       
      </md-checkbox>
</div>


