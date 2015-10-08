<?php

define('PATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

require_once( PATH_BASE.DS.'vendor/autoload.php' );

$app = new Silex\Application();
$app['debug'] = true;

$content_data = array(
	'labels' => array(
		'project_name' => 'Cash machine: Lenin Meza',
		'header_title' => 'Retire dinero fácilmente',
		'header_desc' => 'Con <a href="http://silex.sensiolabs.org/" target="_blank">Silex</a> puede retirar dinero más fácilmente, evítese de problemas!',
		'footer' => 'Lenin Meza 2015'
	)
);

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => PATH_BASE.DS.'views',
));

// Root Web Application
$app->get('/', function () use ($app, $content_data) {
	return $app['twig']->render('layout.html.twig', $content_data);
})->bind('homepage');

$app->post('/ammount/{currency}', function ($currency) use ($app) {
	$currency = floatval(trim($currency));
	
	return $currency;
});

$app->run();
?>
