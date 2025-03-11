<?php
require("PhotoSkeleton.php");
require(__DIR__ . '/../config/connection.php');

class Photo extends PhotoSkeleton {
    public static function save() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO photos (user_id, title, description, image_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", self::$user_id, self::$title, self::$description, self::$image_url);
        $stmt->execute();
        self::$id = $conn->insert_id;
        return true;
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM photos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function find($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM photos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function update() {
        global $conn;
        $stmt = $conn->prepare("UPDATE photos SET title=?, description=?, image_path=? WHERE id=?");
        $stmt->bind_param("sssi", self::$title, self::$description, self::$image_url, self::$id);
        return $stmt->execute();
    }

    public static function delete() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM photos WHERE id=?");
        $stmt->bind_param("i", self::$id);
        return $stmt->execute();
    }
};
?>