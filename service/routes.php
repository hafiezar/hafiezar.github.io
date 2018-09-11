<?php

$app->get('/hello/{name}', 'CommonController::home');
$app->post('/save', 'CommonController::save');
$app->get('/users', 'CommonController::getUsers');
