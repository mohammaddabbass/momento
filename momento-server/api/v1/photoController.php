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
require(__DIR__ . '../../../models/Tag.php');
require(__DIR__ . '../../../models/PhotoTag.php');

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
        // Read JSON input
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (empty($data['user_id']) || empty($data['title']) || empty($data['image'])) {
            http_response_code(400);
            echo json_encode(["message" => "Please fill all the required fields"]);
            exit;
        }
    
        $user_id = $data['user_id'];
        $title = $data['title'];
        $description = $data['description'] ?? '';
        $base64Image = $data['image']; // Base64 string from frontend
    
        // Decode Base64
        $imageParts = explode(';base64,', $base64Image);
        if (count($imageParts) !== 2) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid Base64 format"]);
            exit;
        }
    
        $imageTypeAux = explode('image/', $imageParts[0]);
        $imageType = $imageTypeAux[1] ?? 'png'; // Default to PNG if no type found
        $imageData = base64_decode($imageParts[1]);
    
        if ($imageData === false) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid Base64 data"]);
            exit;
        }
    
        // Save Image
        $uploadDir = realpath(__DIR__ . '/../../uploads') . DIRECTORY_SEPARATOR;
        $fileName = uniqid() . '.' . $imageType; // Generate a unique filename
        $uploadPath = $uploadDir . $fileName;
    
        if (file_put_contents($uploadPath, $imageData)) {
            Photo::create(null, $user_id, $title, $description, $fileName, date('Y-m-d H:i:s'));
            if (Photo::save()) {
                // Handle tags if provided
                echo json_encode(["message"=> "entered here 2"]);
                if (!empty($data['tags'])) {
                    echo json_encode(["message"=> "entered here 3"]);
                    $tags = explode(',', $data['tags']);
                    foreach ($tags as $tagName) {
                        $tagName = trim($tagName);
                        
                        echo json_encode(["tag" => $tagName]);
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