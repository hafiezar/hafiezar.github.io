<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;       


require './vendor/autoload.php';
require './config/config.php';
require './config/database.php';
require './environment.php';

$app = new \Slim\App(['settings' => $config]);

require './controllers/CommonController.php';
require './controllers/AuthController.php';
require './controllers/EventController.php';
require './controllers/ProfileController.php';
require './middleware/Auth.php';

require './routes.php';


$app->run();