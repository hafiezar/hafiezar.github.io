<?php

class AuthController{
    public function login($request, $response, $args){
        $db = Database::connect();

        // Find user based on Email
        $email = $request->getParsedBody()['email'];
        $query = $db->prepare("SELECT * FROM userx WHERE email=:email");
        $query->execute([
            "email" => $email,
        ]);
       
        // Fetch the result of query before 
        $user = $query->fetch(\PDO::FETCH_OBJ);

        // If user not exist in DB, return response
        if(!$user){
            return $response->withJson([
                'message'=> 'Data Not Found'
            ], 404);
        }

        // If user exist, next step check the password of user input
        $passwordCheck = password_verify($request->getParsedBody()['password'], $user->password);

        // If password doesn't match with any of record, return response
         if (!$passwordCheck) {
            return $response->withJson([
                "message" => "Password Mismatched"
            ])->withStatus(401);
        }
        
        // If password match, make generate TOKEN with base64 encode
        $token = base64_encode($user->email);
        $query2 = $db->prepare("UPDATE userx SET token=:token WHERE email=:email");
        $query2->execute([
            "email" => $request->getParsedBody()['email'],
            "token" => $token
        ]);

        return $response->withJson([
            "message" => "Authentication Success",
            "data" => [
                "token" => $token
            ]
        ],200);
    }

    public function register($request,$response, $args){
        $db = Database::connect();
        
        $email= $request->getParsedBody()['email'];
        $pw= $request->getParsedBody()['password'];
        $password = password_hash($pw, PASSWORD_DEFAULT);
        $nama= $request->getParsedBody()['nama'];
        $tanggal_lahir= $request->getParsedBody()['tanggal_lahir'];
        $instansi= $request->getParsedBody()['instansi'];
        $kontak= $request->getParsedBody()['kontak'];
        $created_at= $request->getParsedBody()['created_at'];

        $data = [$email, $password, $nama, $tanggal_lahir, $instansi, $kontak, $created_at];

        $sql = "INSERT INTO userx (email, password, nama, tanggal_lahir,instansi, kontak, created_at) VALUES (?,?,?,?,?,?,?)";
        $stmt= $db->prepare($sql);
         $status = $stmt->execute($data);

      

        if($status){
            return $response->withJson([
                "message" => "register sukses",
            ], 201);
        }else{
            return $response->withJson([
                "message" => "register gagal",
                "data" => $status
            ], 400);
        }
    }



    public function logout($request, $response, $args){
        $db = Database::connect();
         // Get user based on token
        $headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
        $query1->execute(["token" => $apiToken[1], ]);
        $user = $query1->fetch(PDO::FETCH_OBJ);


       
        $query2 = $db->prepare("UPDATE userx SET token=:token WHERE email=:email");
        $status= $query2->execute([
            "email" => $user->email,
            "token" => ""
        ]);

        if($status){
            return $response->withJson([
            "message" => "Logout Success",
           
        ],200);
        }else{
            return $response->withJson([
            "message" => "Logout Gagal",
           
        ],400);
        }
        
    }
}