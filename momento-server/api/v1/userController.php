<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require(__DIR__ . '/../models/User.php');

class UserController {

    static function register() {
        $data = json_decode(file_get_contents('php://input'), true);
        
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
                "user_id" => User::$id 
            ]);
        } else {
            echo json_encode(["message" => 'failed to register']);
        }
    }

    static function login() {
        $data = json_decode(file_get_contents('php://input'), true);
        $user = User::findByEmail($data['email']);
        
        if($user && password_verify($data['password'], $user['password_hash'])) {
            echo json_encode([
                "message" => 'logged in successfully',
                "user" => [
                    "id" => $user['id'],
                    "username" => $user['username'],
                    "email" => $user['email']
                ]
            ]);
        } else {
            echo json_encode(["message" => 'unable to login']);
        }
    }
}