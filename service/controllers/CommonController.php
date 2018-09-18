<?php


use Respect\Validation\Validator as v;
use Respect\Validation\Rules;

class CommonController{
    public function home($request, $response, $args) {
        
        $data = [
            'name' => $args['name'],
            'age' => 40,
        ];
        // $validation = Validator::validate($args, [
        //     $args['name'] =>  Validator::noWhitespace()->notEmpty()
        // ]);

        // $usernameValidator = new Rules\AllOf(
        //     new Rules\Alnum(),
        //     new Rules\NoWhitespace(),
        //     new Rules\Length(1, 15)
        // );
        // $userValidator = new Rules\Key('name', $usernameValidator);
        // $status= $userValidator->validate(['name' => $args['name']]);
       //  $usernameValidator = v::alnum()->noWhitespace()->length(1, 15);
       // $status= $usernameValidator->validate( $args['name']); // true
        
        return $response->withJson($data);
       //  return $response->withJson($status);

       
        

    }
    public function save($request, $response, $args) {
        $data = $request->getParsedBody();
        return $response->withJson($data);
    }
    public function getUsers($request, $response, $args){
        $db = Database::connect();
        $query = $db->prepare("SELECT * FROM userx");
        $query->execute();
        $data = $query->fetchAll(\PDO::FETCH_OBJ);
        return $response->withJson($data);
    }
}