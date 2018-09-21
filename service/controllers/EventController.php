<?php

use Respect\Validation\Validator as v;

class EventController{
    public static function generateRegistrationCode(){
        $db = Database::connect();
        $queryLastRow = $db->prepare("SELECT * FROM userx_eventx ORDER BY id DESC");
        $queryLastRow->execute([]);
        $lastRow = $queryLastRow->fetchAll(PDO::FETCH_OBJ);
        $lastNumber = count($lastRow) ? $lastRow[0]->id : 0;

        $registrationCode = '';
        for($i = 1; $i <= 5 - strlen($lastNumber); $i++){
            $registrationCode .= '0';
        }
        $registrationCode .= $lastNumber+1;
        return $registrationCode;
    }

    public static function bulkCreateMembers($members, $userx_id, $eventx_id){
        $db = Database::connect();
        foreach($members as $val) {
            if($val !== ""){
                $input = [$userx_id, $eventx_id, $val];
                $sql = "INSERT INTO teams (userx_id, eventx_id, team_member) VALUES (?,?,?)";
                $stmt= $db->prepare($sql);
                $status = $stmt->execute($input);      
            }
        }
        return $status;
    }

    public function registerEvent($request,$response, $args){              
        $db = Database::connect();
        $eventx_id= $request->getParsedBody()['eventx_id'];  
        // Get user based on token
        $headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
        $query1->execute(["token" => $apiToken[1], ]);
        $user = $query1->fetch(PDO::FETCH_OBJ);
        //validasi jika sudah mendaftar lomba tidak bisa mendaftar seminar 
        $cekRegisterEvent = $db->prepare("SELECT * FROM userx_eventx WHERE userx_id=:id AND eventx_id=:eventx");
        $cekRegisterEvent->execute(["id" => $user->id, "eventx" => $eventx_id]);
        $statusRegisterEvent = $cekRegisterEvent->fetch(PDO::FETCH_OBJ);
        if(!$statusRegisterEvent){
            // Parsing Data
            $userx_id= $user->id;
            $is_mahasiswa = $user->is_mahasiswa;
            $ign = "";  
            $is_team = ""; 
            $team_name = "";
            $team_member_1 = "";
            $team_member_2 = "";               
            $team_member_3 = "";               
            $team_member_4 = "";  
            $payment_status = "not_paid";
            $created_at= date("Y-m-d h:i:sa");
            $registration_code = self::generateRegistrationCode();

            if($eventx_id == 1 || $eventx_id == 2 || $eventx_id == 3){ //individu
                if($is_mahasiswa == 0){
                    $query2 = $db->prepare("SELECT name, umum_po, umum_ots FROM eventx WHERE id=:eventx_id ");
                    $query2->execute(["eventx_id" => $eventx_id]);
                    $harga = $query2->fetch(PDO::FETCH_OBJ);
                }

                if($is_mahasiswa == 1){
                    $query2 = $db->prepare("SELECT name, mahasiswa_po, mahasiswa_ots FROM eventx WHERE id=:eventx_id ");
                    $query2->execute(["eventx_id" => $eventx_id]);
                    $harga = $query2->fetch(PDO::FETCH_OBJ);
                }                 
                

                // Validation
                $eventx_idValidator = v::digit();
                if(!$eventx_idValidator->validate( $eventx_id)){
                    return $response->withJson([
                        "message" => "Format Id eventx salah"
                    ],400);
                }

                $data = [$userx_id, $eventx_id, $registration_code, $is_team, $ign, $created_at, $payment_status]; 
                $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, registration_code, is_team, ign, created_at, payment_status) VALUES (?,?,?,?,?,?,?)";
                $stmt= $db->prepare($sql);
                $status = $stmt->execute($data); 

                if($eventx_id ==1 || $eventx_id ==2){
                    $payment_status = "paid";
                    $seminar_id = 6;
                    $data2 = [$userx_id, $seminar_id, $registration_code, $is_team, $ign, $created_at, $payment_status, $created_at]; 
                    $sql2 = "INSERT INTO userx_eventx (userx_id, eventx_id, registration_code, is_team, ign, created_at, payment_status, paid_at) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt2= $db->prepare($sql2);
                    $status2 = $stmt2->execute($data2);
                }              

                if($status){
                    return $response->withJson([
                        "message" => "registrasi event sukses",
                        "data" => $harga
                    ], 201);
                }else{
                    return $response->withJson([
                        "message" => "registrasi event gagal",                            
                    ], 400);
                }
            }

            if($eventx_id == 4 || $eventx_id == 5){  // tim
                if($is_mahasiswa == 0){
                    $query2 = $db->prepare("SELECT name, umum_po, umum_ots FROM eventx WHERE id=:eventx_id ");
                    $query2->execute(["eventx_id" => $eventx_id]);
                    $harga = $query2->fetch(PDO::FETCH_OBJ);
                }
                if($is_mahasiswa == 1){
                    $query2 = $db->prepare("SELECT name, mahasiswa_po, mahasiswa_ots FROM eventx WHERE id=:eventx_id ");
                    $query2->execute(["eventx_id" => $eventx_id]);
                    $harga = $query2->fetch(PDO::FETCH_OBJ);
                }

                $is_team= 1; // alnum
                $team_name= $request->getParsedBody()['team_name']; // alnum
                if($eventx_id == 5){
                    $ign= $request->getParsedBody()['ign']; // alnum
                }                 
                

                // Validation
                $eventx_idValidator = v::digit();
                if(!$eventx_idValidator->validate( $eventx_id)){
                    return $response->withJson([
                        "message" => "Format Id eventx salah"
                    ],400);
                }              
                $teamNameValidator = v::alnum();
                if(!$teamNameValidator->validate( $team_name)){
                    return $response->withJson([
                        "message" => "Format Team Name salah"
                    ],400);
                }

                //array to be INSERT
                $data = [$userx_id, $eventx_id, $registration_code, $is_team, $ign, $created_at, $team_name, $payment_status];

                $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, registration_code, is_team, ign, created_at, team_name, payment_status) VALUES (?,?,?,?,?,?,?,?)";
                $stmt= $db->prepare($sql);
                $status = $stmt->execute($data);

                $members = $request->getParsedBody()['team_members'];
                $status = self::bulkCreateMembers($members, $userx_id, $eventx_id);

                if($status){
                    return $response->withJson([
                        "message" => "registrasi event sukses",
                        "data" => $harga
                    ], 201);
                }else{
                    return $response->withJson([
                        "message" => "registrasi event gagal",
                        
                    ], 400);
                }

            }
            
            if($eventx_id == 6 || $eventx_id == 7){ //seminar
                if($is_mahasiswa == 0){
                    $query2 = $db->prepare("SELECT name, umum_po, umum_ots FROM eventx WHERE id=:eventx_id ");
                    $query2->execute(["eventx_id" => $eventx_id]);
                    $harga = $query2->fetch(PDO::FETCH_OBJ);
                }

                if($is_mahasiswa == 1){
                    $query2 = $db->prepare("SELECT name, mahasiswa_po, mahasiswa_ots FROM eventx WHERE id=:eventx_id ");
                    $query2->execute(["eventx_id" => $eventx_id]);
                    $harga = $query2->fetch(PDO::FETCH_OBJ);
                }                   

                // Validation
                $eventx_idValidator = v::digit();
                $statusEventxId = $eventx_idValidator->validate( $eventx_id);
                if(!$statusEventxId){
                    return $response->withJson([
                        "message" => "Format Id eventx salah"
                    ],400);
                }

                //array to be INSERT
                $data = [$userx_id, $eventx_id, $registration_code, $is_team, $ign, $created_at];
                $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, registration_code, is_team,ign, created_at) VALUES (?,?,?,?,?,?)";
                $stmt= $db->prepare($sql);
                $status = $stmt->execute($data);                

                if($status){
                    return $response->withJson([
                        "message" => "registrasi event sukses",
                        "data" =>$harga
                    ], 201);
                }else{
                    return $response->withJson([
                        "message" => "registrasi event gagal",
                    ], 400);
                }
            }
            
        }else{
            return $response->withJson([
                "message" => "Anda sudah terdaftar pada event"
            ], 400);
        }
    }

    public function getEvent($request, $response, $args){
            $db = Database::connect();
            // Find event based on user token
            $headerValueArray = $request->getHeader('Authorization');
            $apiToken = explode(' ', $headerValueArray[0]);
            $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
            $query1->execute(["token" => $apiToken[1], ]);
            $user = $query1->fetch(PDO::FETCH_OBJ);

            $id = $user->id;
            $query = $db->prepare("SELECT * FROM userx_eventx u 
                JOIN eventx e ON u.eventx_id = e.id
                WHERE u.userx_id=:id");
            $status = $query->execute([
                "id" => $id,
            ]);
            $events = $query->fetchAll(PDO::FETCH_OBJ);

            // Push Details
            foreach($events as $key => $val){
                $query = $db->prepare("SELECT * FROM eventx_detail WHERE eventx_id=:id");
                $query->execute([
                    "id" => $val->eventx_id,
                ]);
                $details = $query->fetchAll(PDO::FETCH_OBJ);
                $val->details = $details;
            }

            return $response->withJson([
                "message" => count($events) ? "Event Ditemukan" : "Event Kosong",
                "data" => $events
            ],200);
    }

    public function submitEvent($request, $response, $args){
            $db = Database::connect();

            $headerValueArray = $request->getHeader('Authorization');
            $apiToken = explode(' ', $headerValueArray[0]);
            $query1 = $db->prepare("SELECT u.*, ue.id as id_userx_eventx, ue.eventx_id FROM userx u JOIN userx_eventx ue ON u.id = ue.userx_id WHERE u.token=:token");
            $query1->execute(["token" => $apiToken[1], ]);
            $user = $query1->fetch(PDO::FETCH_OBJ);

            $userx_eventx_id = $user->eventx_id;
            $id_userx_eventx = $user->id_userx_eventx;
            $file = "";
            $link = "";

            

            if($userx_eventx_id == 2 || $userx_eventx_id == 3){
                
                    //move to folder
                $directory = Environment::getDir('/file');

                $uploadedFiles = $request->getUploadedFiles();

                // handle single input with single file upload
                $uploadedFile = $uploadedFiles['file'];     
                

                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
                $filename = sprintf('%s.%0.8s', $basename, $extension);

                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                //return $filename;

                
                $response->write('uploaded ' . $filename . '<br/>');

                $loc_file = Environment::getLink('/file').'/'.$filename;
                $data = [$id_userx_eventx, $loc_file];
                $sql = "INSERT INTO submitx (userx_eventx_id, file) VALUES (?,?)";
                $stmt= $db->prepare($sql);
                $status = $stmt->execute($data); 

                    if($status){
                    return $response->withJson([
                            "message" => "Submit sukses",
                        ],200);

                    }else{
                            return $response->withJson([
                            "message" => "Submit gagal"
                        ],400);
                    }   

            }else if($userx_eventx_id == 4){
                    //move to folder

                $link = $request->getParsedBody()['link'];
                $linkValidator = v::url();
                $statusLink = $linkValidator->validate( $link);
                    if(!$statusLink){
                    return $response->withJson([
                        "message" => "Format Url salah"
                    ],400);
                    }
                $data = [$id_userx_eventx, $link];
                $sql = "INSERT INTO submitx (userx_eventx_id, link) VALUES (?,?)";
                $stmt= $db->prepare($sql);
                $status = $stmt->execute($data); 

                if($status){
                    return $response->withJson([
                            "message" => "Submit sukses",
                        ],200);

                    }else{
                            return $response->withJson([
                            "message" => "Submit gagal"
                        ],400);
                    }   

            }else{
                        return $response->withJson([
                            "message" => "Submit gagal, event tidak memerlukan data submit",
                            
                        ],400);

            }

    }

    public function uploadBuktiBayar($request, $response, $args){
        
            $db = Database::connect();       
    
            $headerValueArray = $request->getHeader('Authorization');
            $apiToken = explode(' ', $headerValueArray[0]);
            $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
            $query1->execute(["token" => $apiToken[1], ]);
            $user = $query1->fetch(PDO::FETCH_OBJ);

            //move to folder
            $directory = Environment::getDir('/bukti_bayar');

            $uploadedFiles = $request->getUploadedFiles();

            // handle single input with single file upload
            $uploadedFile = $uploadedFiles['bukti_bayar']; 

            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);    
            
            $response->write('uploaded ' . $filename . '<br/>');
            $loc_bukti_bayar = Environment::getLink('/bukti_bayar').'/'.$filename;

            $eventx_id = $request->getParsedBody()['eventx_id'];
            $query2 = $db->prepare("UPDATE userx_eventx SET bukti_bayar=:loc_bukti_bayar, payment_status=:payment_status WHERE userx_id=:userx_id AND eventx_id=:eventx_id");
            $status= $query2->execute([
                "userx_id" => $user->id,
                "eventx_id" => $eventx_id,
                "loc_bukti_bayar" => $loc_bukti_bayar,
                "payment_status"=> "wait_verified"
            ]);
            if($status){
                return $response->withJson([
                    "message" => "Upload Success", 
                    "data" => $loc_bukti_bayar          
                ],200);
            }
            return $response->withJson([
                "message" => "Upload Gagal",           
            ],400);

    }

    public function isPaid($request, $response, $args){
        
            $db = Database::connect();   
            $id = $args['id'];  
            $paid_at = date("Y-m-d h:i:sa");
    
            $query2 = $db->prepare("UPDATE userx_eventx SET  payment_status=:payment_status , paid_at=:paid_at WHERE id=:id");
            $status= $query2->execute([
                "id" => $id,
                "payment_status"=> "paid",
                "paid_at" =>$paid_at
            ]);
            if($status){
                return $response->withJson([
                "message" => "Verifikasi sukses", 
                "data" => "paid"          
            ],200);
            }else{
                return $response->withJson([
                "message" => "Verifikasi Gagal",           
            ],400);
            }  

    }

    public function verificationEventPage($request, $response, $args){
            $db = Database::connect();
            // // Find event based on user token
            // $headerValueArray = $request->getHeader('Authorization');
            // $apiToken = explode(' ', $headerValueArray[0]);
            // $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
            // $query1->execute(["token" => $apiToken[1], ]);
            // $user = $query1->fetch(PDO::FETCH_OBJ);

            
            $query = $db->prepare("SELECT u.*, ue.*, e.* FROM userx u LEFT JOIN userx_eventx ue ON u.id=ue.userx_id LEFT JOIN eventx e ON ue.eventx_id = e.id WHERE ue.payment_status='wait_verified' ");
            $status = $query->execute();
            $user = $query->fetchAll(PDO::FETCH_OBJ);
            if($user){
                return $response->withJson([
                    "message" => "Data Ditemukan",
                    "data" => $user
                ],200);
            }else{
                    return $response->withJson([
                    "message" => "Data Tidak Ditemukan"
                ],400);
            }       
    }
   
}