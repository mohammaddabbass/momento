<?php
require("PhotosTagSkeleton.php");
require(__DIR__ . '/../connection/connection.php');

class PhotosTag extends PhotoTagSkeleton {
    public static function save() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO photos_tags (photo_id, tag_id) VALUES (?, ?)");
        $stmt->bind_param("ii", self::$photo_id, self::$tag_id);
        return $stmt->execute();
    }

    public static function delete() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM photos_tags WHERE photo_id=? AND tag_id=?");
        $stmt->bind_param("ii", self::$photo_id, self::$tag_id);
        return $stmt->execute();
    }

    public static function getPhotoTags($photo_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT tags.* FROM tags 
                               JOIN photos_tags ON tags.id = photos_tags.tag_id 
                               WHERE photos_tags.photo_id = ?");
        $stmt->bind_param("i", $photo_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function getTagPhotos($tag_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT photos.* FROM photos 
                               JOIN photos_tags ON photos.id = photos_tags.photo_id 
                               WHERE photos_tags.tag_id = ?");
        $stmt->bind_param("i", $tag_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
};
?>