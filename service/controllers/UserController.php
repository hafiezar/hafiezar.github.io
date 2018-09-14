<?php

class UserController{
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
        $tanggal_lahir= $request->getParsedBody()['tanggal_lahir'];
        $instansi= $request->getParsedBody()['instansi'];
        $kontak= $request->getParsedBody()['kontak'];
        $created_at= $request->getParsedBody()['created_at'];

        $data = [$email, $password, $nama, $tanggal_lahir, $instansi, $kontak, $created_at];

        $sql = "INSERT INTO userx (email, password, nama, tanggal_lahir,instansi, kontak, created_at) VALUES (?,?,?,?,?,?,?)";
        $stmt= $db->prepare($sql);
         $status = $stmt->execute($data);

       // $status = $stmt->fetch(\PDO::FETCH_OBJ);

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

    public function userxEventx($request,$response, $args){
        $db = Database::connect();
        
        $userx_id= $request->getParsedBody()['userx_id'];
        $eventx_id= $request->getParsedBody()['eventx_id'];
        $bukti_bayar= $request->getParsedBody()['bukti_bayar'];
        $created_at= $request->getParsedBody()['created_at'];

        $data = [$userx_id, $eventx_id, $bukti_bayar, $created_at];

        $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, bukti_bayar, created_at) VALUES (?,?,?,?)";
        $stmt= $db->prepare($sql);
        $status = $stmt->execute($data);

     

        if($status){
            return $response->withJson([
                "message" => "registrasi event sukses",
            ], 201);
        }else{
            return $response->withJson([
                "message" => "registrasi event gagal",
                "data" => $status
            ], 400);
        }
    }
}