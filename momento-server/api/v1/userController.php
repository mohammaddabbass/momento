<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require(__DIR__ . '../../../models/User.php');

class UserController {

    static function register() {
        $data = json_decode(file_get_contents('php://input'), true);

        if(empty($data['email']) || empty($data['username']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(["message" => "fill all the required fields"]);
            exit;
        }

        $user = User::findByEmail($data['email']);

        if($user) {
            echo json_encode(["message" => "email already exists"]);
            exit();
        }
        
        User::create(
            null, 
            $data['username'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            date('Y-m-d H:i:s')
        );
        
        if(User::save()) {
            echo json_encode([
                "message" => 'Registered successfully',
                "user" => User::toArray() 
            ]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => 'failed to register']);
        }
    }

    static function login() {
        $data = json_decode(file_get_contents('php://input'), true);

        if(empty($data['email']) ||empty($data['password'])) {
            http_response_code(400);
            echo json_encode(["message" => "fill all the required fields"]);
            exit;
        }

        $user = User::findByEmail($data['email']);
        
        if($user && password_verify($data['password'], $user['password'])) {
            echo json_encode([
                "message" => 'logged in successfully',
                "user" => $user::toArray()
            ]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => 'unable to login']);
        }
    }
}