<?php


class Auth
{ 
	public function __invoke($request, $response, $next)
	{
		$headerValueArray = $request->getHeader('Authorization');
		$apiToken = explode(' ', $headerValueArray[0]);
		$db = Database::connect();
		$query = $db->prepare("SELECT * FROM userx WHERE token=:token");
		$query->execute(["token" => $apiToken[1], ]);
		$user = $query->fetch(PDO::FETCH_OBJ);
		if ($user){
			$response = $next($request, $response, $user);
			return $response;
		}else{
			return $response->withJson(["message" => "Token Salah"],400);
		}
	}

	
}
