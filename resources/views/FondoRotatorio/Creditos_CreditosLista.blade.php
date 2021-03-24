<md-card ng-repeat="Credito in Creditos" class="Cred" md-ink-ripple="#000000" ng-click="verCredito(CredSel)">
	include('Credito.Creditos_CreditCard')
</md-card>

<md-button ng-click="nuevoCredito($event)"
 	class="md-fab md-fab-bottom-right pos-fixed no-margin" aria-label="Nuevo Credito">
 	<md-tooltip md-direction=left>Nuevo Crédito</md-tooltip>
	<md-icon md-svg-icon="md-plus"></md-icon>
</md-button>