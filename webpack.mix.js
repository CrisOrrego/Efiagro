const mix = require('laravel-mix');
const libs = false;

if(libs){

	mix.scripts([

		'resources/js/libs/jquery.min.js',
		'resources/js/libs/angular.min.js',
		'resources/js/libs/angular-material.min.js',
	    
	    'resources/js/libs/other/moment.min.js',
	    'resources/js/libs/other/moment_es.js',
	    'resources/js/libs/other/xlsx.mini.min.js',
	    'resources/js/libs/other/jsstore.js',

	], 'public/js/libs.min.js');
	
};

mix.sass('resources/sass/app.scss', 'public/css/app.min.css');

mix.scripts([

	'resources/js/app.js',
	'resources/js/controllers/MainCtrl.js',

], 'public/js/app.min.js');