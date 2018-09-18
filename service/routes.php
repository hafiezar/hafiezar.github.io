<?php

$app->post('/login', 'AuthController::login');
$app->post('/register', 'AuthController::register');
$app->get('/verifikasi/{token}', 'AuthController::verifikasi');
$app->post('/event/register', 'EventController::registerEvent')->add( new Auth() );
$app->get('/event/user/{id}', 'EventController::getEvent')->add( new Auth() );
//$app->post('/event/submit/{id}', 'EventController::submitEvent')->add( new Auth() );
$app->post('/logout', 'AuthController::logout')->add( new Auth() );
$app->post('/upload/ktm', 'AuthController::uploadKtm')->add( new Auth() );
$app->post('/upload/foto', 'AuthController::uploadFoto')->add( new Auth() );
$app->post('/edit/profile', 'ProfileController::editProfile')->add( new Auth() );
$app->get('/hello/{name}', 'CommonController::home');
$app->post('/save', 'CommonController::save');
$app->get('/users', 'CommonController::getUsers')->add( new Auth() );
