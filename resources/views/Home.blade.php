<div flex id="Home" ng-controller="HomeCtrl">
	
	<md-toolbar class="">
		<div class="md-toolbar-tools">
			<h2>Efiagro</h2>
			<span flex></span>
			<h2>@{{ Usuario.nombre }}</h2>
			<md-button class="md-icon-button" ng-click="Logout()">
				<md-icon md-font-icon="fa-power-off fa-lg"></md-icon>
				<md-tooltip>Cerrar Sesion</md-tooltip>
			</md-button>
		</div>
	</md-toolbar>

</div>