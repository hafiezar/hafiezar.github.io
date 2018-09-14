<?php

$app->post('/login', 'UserController::login');
$app->post('/register', 'UserController::register');
$app->post('/register/event', 'UserController::userxEventx')->add( new Auth() );
$app->get('/hello/{name}', 'CommonController::home')->add( new Auth() );
$app->post('/save', 'CommonController::save');
$app->get('/users', 'CommonController::getUsers')->add( new Auth() );
