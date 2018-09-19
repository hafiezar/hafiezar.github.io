<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './config/config.php';
require './config/database.php';
require './environment.php';

$app = new \Slim\App(['settings' => $config]);

function publicHost(){
	$publicHost = '//localhost:8085/index.php';
	return $publicHost;
};

function emailConfig(){
	$config = ['username'=>'itexpo.unj@gmail.com', 'password'=>'12345expo;'];
	return $config;
}

function directory(){
	$directory = __DIR__ ;
	return $directory;
}

require './controllers/CommonController.php';
require './controllers/AuthController.php';
require './controllers/EventController.php';
require './controllers/ProfileController.php';
require './middleware/Auth.php';

require './routes.php';

$app->run();