<?php

use Respect\Validation\Validator as v;

class EventController{
        public function registerEvent($request,$response, $args){
            $db = Database::connect();            
            // Get user based on token
            $headerValueArray = $request->getHeader('Authorization');
            $apiToken = explode(' ', $headerValueArray[0]);
            $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
            $query1->execute(["token" => $apiToken[1], ]);
            $user = $query1->fetch(PDO::FETCH_OBJ);
            //validasi jika sudah mendaftar lomba tidak bisa mendaftar seminar 
            $cekRegisterEvent = $db->prepare("SELECT * FROM userx_eventx WHERE userx_id=:id");
            $cekRegisterEvent->execute(["id" => $user->id]);
            $statusRegisterEvent = $cekRegisterEvent->fetch(PDO::FETCH_OBJ);            
            if(!$statusRegisterEvent){
                // Parsing Data
                $userx_id= $user->id;
                $is_mahasiswa = $user->is_mahasiswa;
                $eventx_id= $request->getParsedBody()['eventx_id'];                
                $ign = "";  
                $is_team = ""; 
                $team_name = "";
                $team_member_1 = "";
                $team_member_2 = "";               
                $team_member_3 = "";               
                $team_member_4 = "";  
                $payment_status = "not_paid";             
                //$bukti_bayar= $request->getParsedBody()['bukti_bayar'];
                $created_at= date("Y-m-d h:i:sa");
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
                    $statusEventxId = $eventx_idValidator->validate( $eventx_id);
                     if(!$statusEventxId){
                        return $response->withJson([
                            "message" => "Format Id eventx salah"
                        ],400);
                     }
                    $createdValidator = v::date();
                    $statusCreated = $createdValidator->validate( $created_at); 
                     if(!$statusCreated){
                        return $response->withJson([
                            "message" => "Format created_at salah"
                        ],400);
                     }
                    //    //array to be INSERT
                   $data = [$userx_id, $eventx_id, $is_team, $ign, $created_at, $payment_status]; 
                    $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, is_team, ign, created_at, payment_status) VALUES (?,?,?,?,?,?)";
                    $stmt= $db->prepare($sql);
                    $status = $stmt->execute($data);               

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
                    $team_member_1= $request->getParsedBody()['team_member_1']; // alnum
                    $team_member_2= $request->getParsedBody()['team_member_2']; // alnum
                    $team_member_3= $request->getParsedBody()['team_member_3']; // alnum
                    $team_member_4= $request->getParsedBody()['team_member_4']; // alnum
                    if($eventx_id == 5){
                        $ign= $request->getParsedBody()['ign']; // alnum
                    }                 
                    

                    // Validation
                    $eventx_idValidator = v::digit();
                    $statusEventxId = $eventx_idValidator->validate( $eventx_id);
                     if(!$statusEventxId){
                        return $response->withJson([
                            "message" => "Format Id eventx salah"
                        ],400);
                     }
                    $createdValidator = v::date();
                    $statusCreated = $createdValidator->validate( $created_at); 
                     if(!$statusCreated){
                        return $response->withJson([
                            "message" => "Format created_at salah"
                        ],400);
                     }                  
                    $teamNameValidator = v::alnum();
                    $statusTeamName = $teamNameValidator->validate( $team_name); 
                     if(!$statusTeamName){
                        return $response->withJson([
                            "message" => "Format Team Name salah"
                        ],400);
                     }
                    $teamMember1Validator = v::alnum();
                    $statusTeamMember1 = $teamMember1Validator->validate( $team_member_1); 
                     if(!$statusTeamMember1){
                        return $response->withJson([
                            "message" => "Format Team Member 1 salah"
                        ],400);
                     }
                    $teamMember2Validator = v::alnum();
                    $statusTeamMember2 = $teamMember2Validator->validate( $team_member_2); 
                     if(!$statusTeamMember2){
                        return $response->withJson([
                            "message" => "Format Team Member 2 salah"
                        ],400);
                     }
                    $teamMember3Validator = v::alnum();
                    $statusTeamMember3 = $teamMember3Validator->validate( $team_member_3); 
                     if(!$statusTeamMember3){
                        return $response->withJson([
                            "message" => "Format Team Member 3 salah"
                        ],400);
                     }
                    $teamMember4Validator = v::alnum();
                    $statusTeamMember4 = $teamMember4Validator->validate( $team_member_4); 
                     if(!$statusTeamMember4){
                        return $response->withJson([
                            "message" => "Format Team Member 4 salah"
                        ],400);
                     }
                       //array to be INSERT
                    $data = [$userx_id, $eventx_id, $is_team, $ign, $created_at, $team_name, $team_member_1, $team_member_2, $team_member_3, $team_member_4, $payment_status];

                    $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, is_team, ign, created_at, team_name, team_member_1, team_member_2, team_member_3, team_member_4, payment_status) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt= $db->prepare($sql);
                    $status = $stmt->execute($data);                 

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
                     $createdValidator = v::date();
                     $statusCreated = $createdValidator->validate( $created_at); 
                      if(!$statusCreated){
                        return $response->withJson([
                            "message" => "Format created_at salah"
                        ],400);
                      }
                       //array to be INSERT
                     $data = [$userx_id, $eventx_id, $is_team, $ign, $created_at];
                     $sql = "INSERT INTO userx_eventx (userx_id, eventx_id, is_team,ign, created_at) VALUES (?,?,?,?,?)";
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
                $query = $db->prepare("SELECT u.*, e.* FROM userx_eventx u JOIN eventx e ON u.eventx_id = e.id WHERE u.userx_id=:id");
                $status = $query->execute([
                    "id" => $id,
                ]);
                $user = $query->fetch(PDO::FETCH_OBJ);
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
                    $directory = directory().'\\uploads\\file';


                    $uploadedFiles = $request->getUploadedFiles();

                    // handle single input with single file upload
                    $uploadedFile = $uploadedFiles['file'];     
                    

                    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
                    $filename = sprintf('%s.%0.8s', $basename, $extension);

                    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                    //return $filename;

                    
                    $response->write('uploaded ' . $filename . '<br/>');

                    $loc_file = $directory.'\\'.$filename;
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
                $directory = directory().'\\uploads\\bukti_bayar';

                $uploadedFiles = $request->getUploadedFiles();

                // handle single input with single file upload
                $uploadedFile = $uploadedFiles['bukti_bayar'];     
                

                $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
                $filename = sprintf('%s.%0.8s', $basename, $extension);

                $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

                //return $filename;

                
                $response->write('uploaded ' . $filename . '<br/>');

                $loc_bukti_bayar = $directory.'\\'.$filename;
                //update db
                $query2 = $db->prepare("UPDATE userx_eventx SET bukti_bayar=:loc_bukti_bayar, payment_status=:payment_status WHERE userx_id=:userx_id");
                $status= $query2->execute([
                    "userx_id" => $user->id,
                    "loc_bukti_bayar" => $loc_bukti_bayar,
                    "payment_status"=> "wait_verified"
                ]);
                if($status){
                    return $response->withJson([
                    "message" => "Upload Success", 
                    "data" => $loc_bukti_bayar          
                ],200);
                }else{
                    return $response->withJson([
                    "message" => "Upload Gagal",           
                ],400);
                }    

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