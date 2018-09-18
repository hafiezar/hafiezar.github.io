<?php
use Respect\Validation\Validator as v;

class ProfileController{

	 public function editProfile($request,$response, $args){
        $db = Database::connect();        

        $headerValueArray = $request->getHeader('Authorization');
        $apiToken = explode(' ', $headerValueArray[0]);
        $query1 = $db->prepare("SELECT * FROM userx WHERE token=:token");
        $query1->execute(["token" => $apiToken[1], ]);
        $user = $query1->fetch(PDO::FETCH_OBJ);

        // Parsing all request      
        $nama= $request->getParsedBody()['nama'];
        $id= $user->id;
        $tanggal_lahir= $request->getParsedBody()['tanggal_lahir'];
        $instansi= $request->getParsedBody()['instansi'];
        $kontak= $request->getParsedBody()['kontak'];
        // Validation
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
       
  
        $data = [$nama, $tanggal_lahir, $instansi, $kontak];
        $sql = "UPDATE userx set nama=:nama, tanggal_lahir=:tanggal_lahir, instansi=:instansi, kontak=:kontak WHERE id=:id";
        $stmt= $db->prepare($sql);
        $status = $stmt->execute([
            "nama" => $data['0'],
            "tanggal_lahir" => $data['1'],
            "instansi" => $data['2'],
            "kontak" => $data['3'],
            "id" =>$id
        ]);  
         // generate TOKEN with base64 encode for verification           
        if($status){            
            return $response->withJson([
                "message" => "edit sukses",
                "data" => $data
            ], 201);
        }else{
            return $response->withJson([
                "message" => "edit gagal",
            ], 400);
        }
        
        
    }
}