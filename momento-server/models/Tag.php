<?php
require("TagSkeleton.php");
require(__DIR__ . '/../config/connection.php');

class Tag extends TagSkeleton {
    public static function save() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO tags (name) VALUES (?)");
        $stmt->bind_param("s", self::$name);
        $stmt->execute();
        self::$id = $conn->insert_id;
        return true;
    }

    public static function all() {
        global $conn;
        $result = $conn->query("SELECT * FROM tags");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function find($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM tags WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function findByName($name) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM tags WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function delete() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM tags WHERE id = ?");
        $stmt->bind_param("i", self::$id);
        return $stmt->execute();
    }


};
?>