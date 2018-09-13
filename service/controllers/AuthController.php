<?php

class AuthController{
    public function login($request, $response, $args){
        $db = Database::connect();

        $email = $request->getParsedBody()['email'];

        $query = $db->prepare("SELECT * FROM userx WHERE email=:email");
       
          $query->execute([
                "email" => $email,
            ]);
       
          $user = $query->fetch(\PDO::FETCH_OBJ);
        if(!$user){
       

             return $response->withJson([
            'message'=> 'Data Not Found'

             ], 404);
        }
       
        $passwordCheck = password_verify($request->getParsedBody()['password'], $user->password);
         if (!$passwordCheck) {
            return $response->withJson([
                "message" => "Password Mismatched"
            ])->withStatus(401);
        }
       
       
        
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
             $sekolah= $request->getParsedBody()['sekolah'];
             $jurusan= $request->getParsedBody()['jurusan'];
             $tanggal_lahir= $request->getParsedBody()['tanggal_lahir'];
             $payment= $request->getParsedBody()['payment'];


             $data = [$email, $password, $nama, $sekolah, $jurusan, $tanggal_lahir, $payment];

             $sql = "INSERT INTO userx (email, password, nama, sekolah, jurusan, tanggal_lahir, payment) VALUES (?,?,?,?,?,?,?)";
             $stmt= $db->prepare($sql);
             $stmt->execute($data);


             $status = $stmt->fetch(\PDO::FETCH_OBJ);

             if($status){
                 return $response->withJson([
                    "message" => "register sukses",
                 ], 201);
             }else{
                 return $response->withJson([
                    "message" => "register gagal",
                 ], 400);
             }
        
        
    }
}