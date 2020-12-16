<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// Config for app
$config['displayErrorDetails'] = true;
$config['addContentLengthheader'] = false;

//Config for Database
$config['db']['host']   = 'localhost';
$config['db']['user']   = 'user';
$config['db']['pass']   = 'password';
$config['db']['dbname'] = 'exampleapp';

$app = new \Slim\App(['settings' => $config]);

$app->get('/hello/{name}', function (Request $request, Response $response, array $args){
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

// Grouping Middleware

$app->group('/utils', function () use ($app) {
    $app->get('/date', function ($request, $response) {
        return $response->getBody()->write(date('Y-m-d'));
    });
    $app->get('/time', function ($request, $response) {
        return $response->getBody()->write(date('H:i:s'));
    });
})->add(function ($request, $response, $next) {
    $response->getBody()->write('It is now ');
    $response = $next($request, $response);
    $response->getBody()->write('. Enjoy!');

    return $response;
});
$app->run();