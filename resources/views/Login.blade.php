<div id="Login" ng-controller="LoginCtrl" flex layout layout-align="center top">

<div class="login">
	<img src="imgs/logo_home.png" style="display: block;margin: 0 auto;" />
	<md-card class="mw300" layout="column">
	<form flex layout=column ng-submit="enviarLogin($event)">
		<md-card-content flex layout=column>

			<div class="s120 border-rounded" style="background-color: lightgray; margin: 0 auto 10px;"></div>

			<md-input-container class="md-icon-float">
				<label>Correo o Cedula</label>
				<md-icon md-font-icon="fa-user fa-fw"></md-icon>
				<input type="text" ng-model="Usuario.Correo" required>
			</md-input-container>

			<md-input-container class="md-icon-float">
				<label>Contraseña</label>
				<md-icon md-font-icon="fa-key fa-fw"></md-icon>
				<input type="password" ng-model="Usuario.Password" required>
			</md-input-container>

		</md-card-content>

		<md-card-actions layout layout-align="center center">
			<a class="md-body-1 padding-left" href="#/Recuperar">Olvidé mi contraseña</a>
			<span flex></span>
			<md-button class="md-raised md-primary" type=submit>Ingresar</md-button>
		</md-card-actions>

	</form>
	</md-card>
</div>
	<div class="logos">
		<span class='spacer'></span>
		<div align="center"><img class="" src="imgs/logosentidad.jpeg"  alt="" ></div>
		<span class='spacer'></span>
	</div>

</div>

<style type="text/css">

.logos{
	position: absolute;
	bottom: 0;
}

</style>