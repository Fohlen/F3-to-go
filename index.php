<?php

// Composer autoloader for required packages and dependencies
require_once('lib/autoload.php');

$f3 = \Base::instance();

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

// Load configuration
$f3->config('config.ini');

// Bootstrap the database
$f3->set('DB', new DB\SQL(
	'mysql:host='.$f3->get['database.host'].';port='.$f3->get['database.port'].';dbname='.$f3->get['database.database'],
	$f3->get['database.user'],
	$f3->get['database.password']
));

// Routing scheme. Set the news page as our index and route all requests to their corresponding controllers
// @controller -> @action (@param, optionally)
$f3->route('GET|POST /', 'Controllers\Welcome->index');
$f3->route('GET|POST /@controller', 'Controllers\@controller->index');
$f3->route('GET|POST /@controller/@action', 'Controllers\@controller->@action');
$f3->route('GET|POST /@controller/@action/@param', 'Controllers\@controller->@action');

// Run the framework
$f3->run();
