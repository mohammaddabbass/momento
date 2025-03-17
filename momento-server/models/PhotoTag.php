<?php
require("PhotoTagSkeleton.php");
require(__DIR__ . '/../config/connection.php');

class PhotosTag extends PhotoTagSkeleton {
    public static function save() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO photo_tags (photo_id, tag_id) VALUES (?, ?)");
        $stmt->bind_param("ii", self::$photo_id, self::$tag_id);
        return $stmt->execute();
    }

    public static function delete() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM photo_tags WHERE photo_id=? AND tag_id=?");
        $stmt->bind_param("ii", self::$photo_id, self::$tag_id);
        return $stmt->execute();
    }

    public static function getPhotoTags($photo_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT tags.* FROM tags 
                               JOIN photo_tags ON tags.id = photo_tags.tag_id 
                               WHERE photo_tags.photo_id = ?");
        $stmt->bind_param("i", $photo_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function getTagPhotos($tag_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT photos.* FROM photos 
                               JOIN photo_tags ON photos.id = photo_tags.photo_id 
                               WHERE photo_tags.tag_id = ?");
        $stmt->bind_param("i", $tag_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function deleteAllForPhoto() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM photo_tags WHERE photo_id = ?");
        $stmt->bind_param("i", self::$photo_id);
        return $stmt->execute();
    }
};
?>