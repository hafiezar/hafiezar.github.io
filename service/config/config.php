<?php
if(isset($_SERVER['HTTP_ORIGIN'])){
    $http_origin = $_SERVER['HTTP_ORIGIN'];
    if ($http_origin == "http://ft.unj.ac.id"
		|| $http_origin == "http://localhost"){
        header("Access-Control-Allow-Origin: $http_origin");
    }
	// header("Access-Control-Allow-Origin: *");
	header('Access-Control-Allow-Credential: true');
	header('Access-Control-Allow-Headers: Content-Type, x-www-form-urlencoded, Authorization, X-Requested-With');
	header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS, HEAD');
}

error_reporting(1);
$config['displayErrorDetails'] = false;
$config['addContentLengthHeader'] = true;