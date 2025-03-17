<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require(__DIR__ . '../../../models/Tag.php');


class TagController {

    static function createTag() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        Tag::create(
            null, 
            $data['name']
        );
        
        if(Tag::save()) {
            echo json_encode(["response" => 1, "tag_id" => Tag::$id]);
        } else {
            echo json_encode(["response" => 0]);
        }
    }

    static function getAllTags() {
        $tags = Tag::all();
        echo json_encode(["response" => 1, "data" => $tags]);
    }

    static function deleteTag() {
        $id = $_GET['id'];
        Tag::$id = $id;
        echo json_encode(["response" => Tag::delete() ? 1 : 0]);
    }
}