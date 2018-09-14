<?php

namespace App\middleware;

class Coba
{ 
	
	public function asal(){
		return "coba";
	}

	public function getAuthUser(){
		$headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $db = Database::connect();
        $query = $db->prepare("SELECT * FROM userx WHERE token=:token");
        $query->execute(["token" => $apiToken[1], ]);
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $response->withJson($user);
	}
}
