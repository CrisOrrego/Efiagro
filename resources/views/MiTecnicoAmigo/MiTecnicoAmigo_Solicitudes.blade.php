<div flex layout=column ng-show="Subseccion == 'Solicitudes'">
	
	<div layout class="margin-top">
		<div flex>
			<md-button class="md-raised" ng-click="Subseccion = 'Articulos'">
				<md-icon md-font-icon="fa-arrow-left fa-fw" ></md-icon>
				Volver a Articulos
			</md-button>
		</div>
		<md-button class="md-raised md-primary boton-principal" ng-click="crearCaso()">Crear Nueva Solicitud</md-button>
		<!--INICIO DEV ANGELICA-->
		<div flex>
			<a href="tel:3173562730" ng-click="crearCasoTelefonico('Llamada telefonica')">
								<img src="imgs/contacto/tel.png" alt="" width="45" height="45" HSPACE="10" VSPACE="10" />
			</a>
			<a href="sms:+573173562730?body=Hola Inges de GC!" ng-click="crearCasoTelefonico('SMS')">
								<img src="imgs/contacto/sms.png" alt="" width="45" height="45" HSPACE="10" VSPACE="10" />
			</a>
			<a target="_blank" ng-click="crearCasoTelefonico('Whatsapp')" href="https://api.whatsapp.com/send?phone=3173562730&text=Hola%20Ingenieros%20de%20GC%20">
								<img src="imgs/contacto/wpp.png" alt="" width="45" height="45" HSPACE="10" VSPACE="10" />
			</a>
			<!--FIN DEV ANGELICA--> 	
			</div>
	</div>
	
	<div layout=column flex layout-align="start center" class="padding">
		
		<md-card ng-repeat="Caso in CasosCRUD.rows" layout=column class="padding w100p mxw600 pointer"
			ng-click="novedadesCaso(Caso)">
			<div layout layout-align="space-between center margin-bottom-5">
		
				<div>
					<!--INICIO DEV ANGELICA-->
					<div ng-if="Caso.tipo==='Whatsapp'">
					<i class="fab fa-whatsapp"></i>
					</div>
					<div ng-if="Caso.tipo==='Llamada telefonica'">
					<i class="fas fa-phone-volume"></i>
					</div>
					<div ng-if="Caso.tipo==='SMS'">
					<i class="fas fa-sms"></i>
					</div>
					<!--FIN DEV ANGELICA-->
					<h3 class="md-title no-margin">@{{ Caso.titulo }} @{{Caso.tipo}}</h3>
					<!--INICIO DEV ANGELICA-->
					<h5 class="md-title no-margin">@{{ Caso.solicitante_id }}</h5> <!--el administrador debe ver quien está preguntando-->
					<!--FIN DEV ANGELICA-->
				</div>
				<div>
					<md-icon md-font-icon="fa-edit fa-lg" ng-click="novedadesCaso(Caso)" class="fa fa-edit fa-lg" role="img" aria-label="fa-edit fa-lg"></md-icon>
				</div>
			</div>
			<div class="text-darkgreen text-bold text-14px">
				 	@{{ Caso.novedades.length }} @{{ Caso.novedades.length == 1 ? 'Respuesta' : 'Respuestas' }}
			</div>
		</md-card>
	</div>

</div>
