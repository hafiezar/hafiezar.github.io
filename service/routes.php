<?php

$app->get('/', 'CommonController::home');
$app->post('/login', 'AuthController::login');
$app->post('/register', 'AuthController::register');
$app->post('/register/event', 'EventController::userxEventx')->add( new Auth() );
$app->post('/logout', 'AuthController::logout')->add( new Auth() );

$app->post('/save', 'CommonController::save');
$app->get('/users', 'CommonController::getUsers')->add( new Auth() );
