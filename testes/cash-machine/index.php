<?php

define('PATH_BASE', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require_once PATH_BASE.DS.'vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$content_data = [
    'labels' => [
        'project_name' => 'Cash machine: Lenin Meza',
        'header_title' => 'Retire dinero fácilmente',
        'header_desc'  => 'Con <a href="http://silex.sensiolabs.org/" target="_blank">Silex</a> puede retirar dinero más fácilmente, evítese de problemas!',
        'footer'       => 'Lenin Meza 2015',
    ],
];
$tickets = [
    0 => 100,
    1 => 50,
    2 => 20,
    3 => 10,
];
$total_tickets = [];

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => PATH_BASE.DS.'views',
]);

// Root Web Application
$app->get('/', function () use ($app, $content_data) {
    return $app['twig']->render('layout.html.twig', $content_data);
})->bind('homepage');

// Calculate the number of tickets
$app->post('/ammount/{currency}', function ($currency) use ($app, $tickets, $total_tickets) {
    $total_resto = 0;
    $currency = floatval(trim($currency));
    foreach ($tickets as $key => $ticket) {
        if ($currency >= $ticket && $total_resto == 0) {
            if ($currency == $ticket) {
                $first = floor($currency / $ticket);
                $total_tickets[] = $first.' de a $'.$ticket;
                break;
            } else {
                $first = floor($currency / $ticket);
                if ($first > 0) {
                    $total_tickets[] = $first.' de a $'.$ticket;
                    $resto = $currency % $ticket;
                    if ($resto > 0) {
                        $currency = $resto;
                    } else {
                        $total_resto = 1;
                    }
                }
            }
        }
    }

    return json_encode($total_tickets);
});

$app->run();
