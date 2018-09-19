<?php


use Respect\Validation\Validator as v;
use Respect\Validation\Rules;

class CommonController{
    public function home($request, $response, $args) {
        $data = [
            'name' => 'Test',
        ];
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