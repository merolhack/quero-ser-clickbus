<?php

define('PATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

require_once( PATH_BASE.DS.'vendor/autoload.php' );

$app = new Silex\Application();
$app['debug'] = true;

// Root Web Application: Hola mundo
$app->get('/', function () use ($app) {
    return 'Hola mundo.';
});

$app->run();
?>
