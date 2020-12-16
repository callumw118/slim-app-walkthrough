<?php

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

$routes = require __DIR__ . '/../../app/routes.php';
$routes($app);

$app->run();