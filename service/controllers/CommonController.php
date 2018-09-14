<?php

class CommonController{
    public function home($request, $response, $args) {
        $data = [
            'name' => $args['name'],
            'age' => 40
        ];

        return $response->withJson($data);
        

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