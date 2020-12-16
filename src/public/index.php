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
$app->run();