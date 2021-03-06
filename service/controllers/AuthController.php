<?php

use Respect\Validation\Validator as v;
use Slim\Http\UploadedFile;

class AuthController{
    public function login($request, $response, $args){
         $db = Database::connect();       
         // Find user based on Email
         $email = $request->getParsedBody()['email'];
         // Email Validation
         $emailValidator = v::email();
         $statusEmail = $emailValidator->validate( $email); 
         if($statusEmail){
                // query of find user
                $query = $db->prepare("SELECT * FROM userx WHERE email=:email");
                $query->execute([
                    "email" => $email,
                ]);               
                // Fetch the result of query before 
                $user = $query->fetch(\PDO::FETCH_OBJ);
                $is_verified = $user->is_verified;
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
                if($is_verified == 1){
                     // If password match, make generate TOKEN with base64 encode
                    $secret = "it3xpo2018";
                    $token = base64_encode($user->email.$secret);
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
                }else{
                     return $response->withJson([
                        "message" => "Authentication Gagal, Belum diverifikasi",                        
                    ],400);
                }               
         }else{
                 return $response->withJson([
                    "message" => "Format Email Salah",
                    "data" => $email                    
                ],400);
         }        
       
    }

    public function register($request,$response, $args){
        $db = Database::connect();        
        // Parsing all request
        $email= $request->getParsedBody()['email'];
        $pw= $request->getParsedBody()['password'];    
        $nama= $request->getParsedBody()['nama'];
        $tanggal_lahir= $request->getParsedBody()['tanggal_lahir'];
        $instansi= $request->getParsedBody()['instansi'];
        $kontak= $request->getParsedBody()['kontak'];
        //$created_at= $request->getParsedBody()['created_at'];
        $created_at= date("Y-m-d h:i:sa");
        $status_akun = $request->getParsedBody()['status_akun'];
        

         // Validation
        $emailValidator = v::email();
        $statusEmail = $emailValidator->validate( $email); 
         if(!$statusEmail){
            return $response->withJson([
                "message" => "Format email salah"
            ],400);
         }
        $passwordValidator = v::alnum()->length(6,20)->noWhitespace();
        $statusPassword = $passwordValidator->validate( $pw); 
        if($statusPassword){
            $password = password_hash($pw, PASSWORD_DEFAULT);
        }else{
            return $response->withJson([
                "message" => "Format password salah"
            ],400);
        }
        $namaValidator = v::alnum()->length(3,255)->alpha();
        $statusNama = $namaValidator->validate( $nama);
         if(!$statusNama){
            return $response->withJson([
                "message" => "Format nama salah"
            ],400);
         }
        $ttlValidator = v::date();
        $statusTtl = $ttlValidator->validate( $tanggal_lahir);
         if(!$statusTtl){
            return $response->withJson([
                "message" => "Format tanggal lahir salah"
            ],400);
         }
        $instansiValidator = v::alnum()->length(3,255);
        $statusInstansi = $instansiValidator->validate( $instansi);
         if(!$statusInstansi){
            return $response->withJson([
                "message" => "Format instansi salah"
            ],400);
         }
        $kontakValidator = v::digit()->length(5,14);
        $statusKontak = $kontakValidator->validate( $kontak);
         if(!$statusKontak){
            return $response->withJson([
                "message" => "Format kontak salah"
            ],400);
         }
        $isMahasiswaValidator = v::digit()->length(1);
        $statusIsMahasiswa = $isMahasiswaValidator->validate( $status_akun);
         if(!$statusKontak){
            return $response->withJson([
                "message" => "Format status_akun salah"
            ],400);
         }
        $createdValidator = v::date();
        $statusCreated = $createdValidator->validate( $created_at); 
         if(!$statusCreated){
            return $response->withJson([
                "message" => "Format created_at salah"
            ],400);
         }
        if($statusEmail && $statusPassword && $statusNama && $statusTtl && $statusInstansi && $statusKontak && $statusCreated && $statusIsMahasiswa){
            $data = [$email, $password, $nama, $tanggal_lahir, $instansi, $kontak, $status_akun, $created_at];
            $sql = "INSERT INTO userx (email, password, nama, tanggal_lahir, instansi, kontak, status_akun, created_at) VALUES (?,?,?,?,?,?,?,?)";
            $stmt= $db->prepare($sql);
            $status = $stmt->execute($data);  
             // generate TOKEN with base64 encode for verification           
            if($status){
                $secret = "it3xpo2018Verifikasi";
                $token = base64_encode($email.$secret);
                $query2 = $db->prepare("UPDATE userx SET token_verifikasi=:token WHERE email=:email");
                $query2->execute([
                    "email" => $email,
                    "token" => $token
                ]);

                // Create the Transport
                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                  ->setUsername('itexpo.unj@gmail.com')
                  ->setPassword('12345expo;')
                  ;

                //setting
                $hostPublic= Environment::publicHost();


                // Create the Mailer using your created Transport
                $mailer = Swift_Mailer::newInstance($transport);

                // Create a message
                $message = Swift_Message::newInstance('Thank you for Registering IT EXPO 2018')
                  ->setFrom(array('itexpo.unj@gmail.com' => 'IT EXPO 2018'))
                  ->setTo(array($email => $nama))
                  ->setBody('<html><body>
                                        Klik link di bawah ini untuk melakukan verifikasi: <br/>
                                        <p><a href='.$hostPublic.'/verifikasi/'.$token.'>Verifikasi Akun Saya</a></p>
                                        Terima kasih
                                        <br/><br/>
                                        Panitia IT Expo 2018
                                        </body></html>',
                                        'text/html' // Mark the content-type as HTML
                                        );

                // Send the message
                $result = $mailer->send($message);
                //Create email verification
                // sender setting

                // $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                //   ->setUsername('itexpo.unj@gmail.com')
                //   ->setPassword('12345expo;')
                // ;
                // //setting
                // $hostPublic= Environment::publicHost();
                // // Create the Mailer using your created Transport
                // $mailer = new Swift_Mailer($transport);
                // // Create a message
                // $message = (new Swift_Message('Thank you for Registering IT EXPO 2018'))
                //   ->setFrom(['itexpo.unj@gmail.com' => 'IT EXPO 2018'])
                //   ->setTo([ $email => $nama])
                //   // ->setBody('<a href='localhost:8085/hello/aan'>Klik disini untuk verifikasi</a>', 'text/html')
                //  ->setBody('<html><body>
                //             Klik link di bawah ini untuk melakukan verifikasi: <br/>
                //             <p><a href='.$hostPublic.'/verifikasi/'.$token.'>Verifikasi Akun Saya</a></p>
                //             Terima kasih
                //             <br/><br/>
                //             Panitia IT Expo 2018
                //             </body></html>',
                //             'text/html' // Mark the content-type as HTML
                //             );
                // // Send the message
                // $result = $mailer->send($message);
                return $response->withJson([
                    "message" => "Pendaftaran berhasil! Silakan melakukan verifikasi",
                ], 201);
            }else{
                return $response->withJson([
                    "message" => "Pendaftaran gagal!",
                    "data" => $status
                ], 400);
            }
        }else{
            return $response->withJson([
                "message" => "Terdapat data yang tidak benar"
            ],400);
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
        // remove token from db of user that click logout
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

    public function verifikasi($request, $response, $args){
        $db = Database::connect();       
        $token = $args['token'];
        $query1 = $db->prepare("SELECT * FROM userx WHERE token_verifikasi=:token");
        $query1->execute([
            "token" => $token,
        ]);       
        // Fetch the result of query before 
        $user = $query1->fetch(\PDO::FETCH_OBJ);
        $verified_at= date("Y-m-d h:i:sa");
        $query2 = $db->prepare("UPDATE userx SET is_verified='1', token_verifikasi = '', verified_at =:verified_at WHERE email=:email");
        $status = $query2->execute([
            "email" => $user->email,
            "verified_at" => $verified_at            
        ]);
        $body = $response->getBody();
        if($status){
            $body->write('
                <div style="font-family: Sans-serif; text-align: center; margin-top: 100px;">
                    <h1>Verifikasi Berhasil!</h1>
                    Sedang mengalihkan...
                    <br/><br/><br/>
                    <p>&copy; IT Expo 2018 - Universitas Negeri Jakarta</p>
                </div>
                <script>
                    setTimeout(() => {
                        window.location = "'.Environment::getAppURL().'/login.html'.'"
                    },1000);
                </script>
            ');
            return $response;
        }
        $body->write('
            <div style="font-family: Sans-serif; text-align: center; margin-top: 100px;">
                <h1>Verifikasi Gagal!</h1>
                Silakan hubungi administrator.
                <br/><br/><br/>
                <p>&copy; IT Expo 2018 - Universitas Negeri Jakarta</p>
            </div>
            <script>
                setTimeout(() => {
                    window.location = "'.Environment::getAppURL().'/index.html'.'"
                },1000);
            </script>
        ');
        return $response;
    }

    public function uploadKtm($request, $response, $args){     
        $db = Database::connect();       
        
        $headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
        $query1->execute(["token" => $apiToken[1], ]);
        $user = $query1->fetch(PDO::FETCH_OBJ);

        //move to folder
        $directory = Environment::getDir('/ktm');

        $uploadedFiles = $request->getUploadedFiles();
        
        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['file_ktm'];     
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);
        
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
        
        $response->write('uploaded ' . $filename . '<br/>');

        $loc_file_ktm = Environment::getLink('/ktm').'/'.$filename;
        //update db
        $query2 = $db->prepare("UPDATE userx SET file_ktm=:loc_file_ktm WHERE email=:email");
        $status= $query2->execute([
            "email" => $user->email,
            "loc_file_ktm" => $loc_file_ktm
        ]);
        if($status){
            return $response->withJson([
                "message" => "Upload Success", 
                "data" => $loc_file_ktm          
            ],200);
        }else{
            return $response->withJson([
                "message" => "Upload Gagal",           
            ],400);
        }     

    }

    public function uploadFoto($request, $response, $args){     
        $db = Database::connect();       
        
        $headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
        $query1->execute(["token" => $apiToken[1], ]);
        $user = $query1->fetch(PDO::FETCH_OBJ);

        //move to folder
        $directory = Environment::getDir('/foto');

        $uploadedFiles = $request->getUploadedFiles();

        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['foto'];     

        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        $response->write('uploaded ' . $filename . '<br/>');

        $loc_file_foto = Environment::getLink('/foto').'/'.$filename;
        //update db
        $query2 = $db->prepare("UPDATE userx SET foto=:loc_file_foto WHERE email=:email");
        $status= $query2->execute([
            "email" => $user->email,
            "loc_file_foto" => $loc_file_foto
        ]);
        if($status){
            return $response->withJson([
            "message" => "Upload Success", 
            "data" => $loc_file_foto          
        ],200);
        }else{
            return $response->withJson([
            "message" => "Upload Gagal",           
        ],400);
        }     

    }

    public function getUserByToken($request, $response, $args){
        $db = Database::connect();
        $headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $query1 = $db->prepare("SELECT nama, tanggal_lahir, status_akun, instansi, kontak, email, is_verified, foto, file_ktm, created_at, verified_at FROM userx WHERE token=:token");
        $query1->execute(["token" => $apiToken[1], ]);
        $user = $query1->fetch(PDO::FETCH_OBJ);
        return $response->withJson($user);
    }
}