<?php

$app->post('/login', 'AuthController::login');
$app->post('/register', 'AuthController::register');
$app->get('/hello/{name}', 'CommonController::home')->add( new Auth() );
$app->post('/save', 'CommonController::save');
$app->get('/users', 'CommonController::getUsers')->add( new Auth() );
