<?php

$app->post('/login', 'AuthController::login');
$app->get('/hello/{name}', 'CommonController::home');
$app->post('/save', 'CommonController::save');
$app->get('/users', 'CommonController::getUsers');
