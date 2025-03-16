<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

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

        echo json_encode(["message" => 'photos fetched successfully', "photos" => $photos]);
    }

    static function uploadPhoto() {
        if (empty($_POST['user_id']) || empty($_POST['title'])) {
            http_response_code(400);
            echo json_encode(["message" => "Please fill all the required fields"]);
            exit;
        }
    
        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'] ?? '';
    
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(["message" => "File upload failed"]);
            exit;
        }
        echo json_encode(["error" => $_FILES['image']['error'], "image" => $_FILES['image']]);
    
        $uploadDir = realpath(__DIR__ . '/../../uploads') . DIRECTORY_SEPARATOR;
        $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $fileName;
    
        echo json_encode(["file name is: " => $fileName, "upload path: " => $uploadPath]);
        echo json_encode(["check: " => $_FILES['image']['tmp_name'], "upload path: " => $uploadPath]);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $photo = Photo::create(null, $user_id, $title, $description, $fileName, date('Y-m-d H:i:s'));
            echo json_encode(["message" => "entered"]);
            echo json_encode(["photo" => $photo]);
            
            
            if ($photo && Photo::save()) {
                echo json_encode(["message" => "entered second"]);
                if (!empty($_POST['tags'])) {
                    $tags = explode(',', $_POST['tags']);
                    foreach ($tags as $tagName) {
                        $tagName = trim($tagName);
    
                        $tag = Tag::findByName($tagName);
                        if (!$tag) {
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
    
                http_response_code(200);
                echo json_encode(["message" => "Image uploaded successfully", "file_name" => $fileName]);
                return;
            }
        }
        error_log("Failed to move file. Temp path: " . $_FILES['image']['tmp_name']);
        error_log("Destination path: " . $uploadPath);
        error_log("PHP Error: " . print_r(error_get_last(), true));
    
        http_response_code(400);
        echo json_encode(["message" => "Failed to upload image"]);
    }
    

    static function getPhoto() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "Photo ID is required"]);
            exit;
        }

        $photo = Photo::find($id);

        if (!$photo) {
            http_response_code(404);
            echo json_encode(["message" => "Photo not found"]);
            exit;
        }

        echo json_encode(["message" => "Photo fetched successfully", "data" => $photo]);
    }

    static function updatePhoto() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Photo ID is not found"]);
            exit;
        }
        

        Photo::create(
            $data['id'],
            $data['user_id'] ?? null,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['image_url'] ?? null,
            $data['created_at'] ?? null
        );

        echo json_encode(["message" => Photo::update() ? "Photo updated successfully" : "Failed to update photo"]);
    }

    static function deletePhoto() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "Photo ID is required"]);
            exit;
        }

        Photo::$id = $id;

        if (Photo::delete()) {
            echo json_encode(["message" => "Photo deleted successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to delete photo"]);
        }
    }



    static function getPhotosByTag() {
        $tagId = $_GET['tag_id'];
        $photos = PhotosTag::getTagPhotos($tagId);
        echo json_encode(["response" => 1, "data" => $photos]);
    }

    static function updatePhotoTags() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['photo_id']) || !isset($data['tags'])) {
            http_response_code(400);
            echo json_encode(["message" => "Photo ID and tags are required"]);
            exit;
        }

        $photoId = $data['photo_id'];
        $tags = $data['tags'];

        PhotosTag::$photo_id = $photoId;
        PhotosTag::deleteAllForPhoto();

        foreach ($tags as $tagId) {
            PhotosTag::create($photoId, $tagId);
            PhotosTag::save();
        }

        echo json_encode(["message" => "Photo tags updated successfully"]);
    } 
}