<?php

class EventController{
        public function userxEventx($request,$response, $args){
            $db = Database::connect();
            
            // Get user based on token
            $headerValueArray = $request->getHeader('Authorization');
            $apiToken = explode(' ', $headerValueArray[0]);
            $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
            $query1->execute(["token" => $apiToken[1], ]);
            $user = $query1->fetch(PDO::FETCH_OBJ);

            

            // Initialitation Data
            $userx_id= $user->id;
            $eventx_id= $request->getParsedBody()['eventx_id'];
            $bukti_bayar= $request->getParsedBody()['bukti_bayar'];
            $created_at= $request->getParsedBody()['created_at'];

            //array to be INSERT
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