<?php
require("UserSkeleton.php");
require(__DIR__ . '/../config/connection.php');

class User extends UserSkeleton {
    public static function save() {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", self::$username, self::$email, self::$password);
        $stmt->execute();
        self::$id = $conn->insert_id;
        return true;
    }

    public static function find($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function update() {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET username=?, email=?, password_hash=? WHERE id=?");
        $stmt->bind_param("sssi", self::$username, self::$email, self::$password, self::$id);
        return $stmt->execute();
    }


};
?>