<?php

class AuthController{
    public function login($request, $response, $args){
        $db = Database::connect();
        $query = $db->prepare("SELECT * FROM usersx WHERE email=:email");
        $query->execute([
            "email" => $request->getBody()->email,
        ]);
        $user = $query->fetch(\PDO::FETCH_OBJ);
        if ($user) {
            return $response->withJson([
                "message" => "User not found"
            ])->withStatus(401);
        }
        
        $passwordCheck = password_verify($request->getBody()->password, $user->password);
        if (!$passwordCheck) {
            return $response->withJson([
                "message" => "Password Mismatched"
            ])->withStatus(401);
        }

        $token = password_hash($user->email, PASSWORD_DEFAULT);
        $query = $db->prepare("UPDATE usersx SET token=:token WHERE email=:email");
        $query->execute([
            "email" => $request->getBody()->email,
            "token" => $token
        ]);

        return $response->withJson([
            "message" => "Authentication Success",
            "data" => [
                "token" => $token
            ]
        ]);
    }
}