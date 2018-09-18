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
             // Find event based on user id
                $id = $args['id'];
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
            // $db = Database::connect();

            //  // Find event based on user id
            //     $id = $args['id'];
            //     $query = $db->prepare("SELECT u.*, e.name as event_name FROM userx_eventx u JOIN eventx e ON u.eventx_id = e.id WHERE userx_id=:id");
            //     $status = $query->execute([
            //         "id" => $id,
            //     ]);

            //     $user = $query->fetch(PDO::FETCH_OBJ);

            //     if($user){
            //         return $response->withJson([
            //             "message" => "Data Ditemukan",
            //             "data" => $user
            //         ],200);

            //     }else{
            //          return $response->withJson([
            //             "message" => "Data Tidak Ditemukan"
            //         ],400);
            //     }   
                

        }


        public function submitBuktiBayar($request, $response, $args){
            
                //  $buktiBayarValidator = v::stringType();
                // $statusBuktiBayar = $buktiBayarValidator->validate( $bukti_bayar); 

                //  if(!$statusBuktiBayar){ 
                //     return $response->withJson([
                //         "message" => "Format bukti_bayar salah"
                //     ],400);
                //  }

               

                        // Create the Transport
                        // $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        //   ->setUsername('aangohan2@gmail.com')
                        //   ->setPassword('hanamici')
                        // ;

                        // // Create the Mailer using your created Transport
                        // $mailer = new Swift_Mailer($transport);

                        // // Create a message
                        // $message = (new Swift_Message('Wonderful Subject'))
                        //   ->setFrom(['aangohan2@gmail.com' => 'John Doe'])
                        //   ->setTo(['moctarafendi@gmail.com' => 'AMoctar'])
                        //   ->setBody("<a href='localhost:8085/hello/aan'>Klik disini</a>")
                        //   ;

                        // // Send the message
                        // $result = $mailer->send($message);

                        // return $result;//pyment status wait for verified

        }

         public function toPaid($request, $response, $args){
            
                //  $buktiBayarValidator = v::stringType();
                // $statusBuktiBayar = $buktiBayarValidator->validate( $bukti_bayar); 

                //  if(!$statusBuktiBayar){ 
                //     return $response->withJson([
                //         "message" => "Format bukti_bayar salah"
                //     ],400);
                //  }

               

                        // Create the Transport
                        // $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        //   ->setUsername('aangohan2@gmail.com')
                        //   ->setPassword('hanamici')
                        // ;

                        // // Create the Mailer using your created Transport
                        // $mailer = new Swift_Mailer($transport);

                        // // Create a message
                        // $message = (new Swift_Message('Wonderful Subject'))
                        //   ->setFrom(['aangohan2@gmail.com' => 'John Doe'])
                        //   ->setTo(['moctarafendi@gmail.com' => 'AMoctar'])
                        //   ->setBody("<a href='localhost:8085/hello/aan'>Klik disini</a>")
                        //   ;

                        // // Send the message
                        // $result = $mailer->send($message);

                        // return $result;//pyment status wait for verified

        }
   
}