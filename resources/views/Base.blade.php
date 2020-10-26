<!doctype html>
<html lang="es" ng-app="App" ngs-strict-di>

	<head>
		<meta charset="UTF-8">
		<title>{{ env('APP_NAME') }}</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">

		<link   rel="stylesheet"              		href="/css/app.min.css?202010051927" />

		<script type="application/javascript" src="/js/libs.min.js"></script>
		<script defer type="application/javascript" src="/js/app.min.js?202010051927"></script>
	</head>

	<body layout ng-controller="MainCtrl">
		<div id='Main' ui-view flex layout>@{{ Saludo }}</div>
	</body>
	
</html>