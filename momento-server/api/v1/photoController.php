<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require(__DIR__ . '../../../models/Photo.php');

class PhotoController {

    static function getAllPhotos() {
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];

        if(!$user_id) {
            echo json_encode(["message" => "user unavailable"]);
            exit;
        }

        $photos = Photo::all($user_id);


        if(!$photos) {
            echo json_encode(["message" => "no photos available for the current user"]);
            exit;
        }

        echo json_encode(["message" => 'photos fetched successfully', "data" => $photos]);
    }

    static function uploadPhoto() {
        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'] ?? '';
        
        if(isset($_FILES['image'])) {
            $uploadDir = __DIR__ . '/../uploads/';
            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $uploadPath = $uploadDir . $fileName;

            if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                Photo::create(
                    null, 
                    $user_id,
                    $title,
                    $description,
                    $fileName, 
                    date('Y-m-d H:i:s')
                );

                if(Photo::save()) {
                    if(!empty($_POST['tags'])) {
                        $tags = explode(',', $_POST['tags']);
                        foreach($tags as $tagName) {
                            $tagName = trim($tagName);
                            
                            $tag = Tag::findByName($tagName);
                            if(!$tag) {
                                Tag::create(null, $tagName);
                                Tag::save();
                                $tagId = Tag::$id;
                            } else {
                                $tagId = $tag['id'];
                            }
                            
                            PhotosTag::create(Photo::$id, $tagId);
                            PhotosTag::save();
                        }
                    }
                }
            }
        }
        
        http_response_code(400);
        echo json_encode(["message" => 'failed to upload image']);
    }

    static function getPhoto() {
        $id = $_GET['id'];
        $photo = Photo::find($id);
        
        if($photo) {
            echo json_encode(["message" => 'photo fetched successfully', "data" => $photo]);
        } else {
            echo json_encode(["response" => 'photo not found']);
        }
    }

    static function updatePhoto() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        Photo::create(
            $data['id'],
            $data['user_id'],
            $data['title'],
            $data['description'],
            $data['image_url'], 
            $data['created_at']
        );
        
        echo json_encode(["message" => Photo::update() ? 'success' : 'fail']);
    }

    static function deletePhoto() {
        $id = $_GET['id'];
        Photo::$id = $id;
        
        if(Photo::delete()) {
            echo json_encode(["message" => 'delete successfully']);
        } else {
            echo json_encode(["message" => 'failed to delete photo']);
        }
    }



    static function getPhotosByTag() {
        $tagId = $_GET['tag_id'];
        $photos = PhotosTag::getTagPhotos($tagId);
        echo json_encode(["response" => 1, "data" => $photos]);
    }

    static function updatePhotoTags() {
        $data = json_decode(file_get_contents('php://input'), true);
        $photoId = $data['photo_id'];
        $tags = $data['tags'];
        
        PhotosTag::$photo_id = $photoId;
        PhotosTag::deleteAllForPhoto();
        
        foreach($tags as $tagId) {
            PhotosTag::create($photoId, $tagId);
            PhotosTag::save();
        }
        
        echo json_encode(["response" => 1]);
    }   
}