<?php 
class UserSkeleton {

    public static $id;
    public static $username;
    public static $email;
    public static $password;
    public static $created_at;

    public static function create($id, $username, $email, $password, $created_at){
        self::$id = $id;
        self::$username = $username;
        self::$email = $email;
        self::$password = $password;
        self::$created_at = $created_at;
    }

}

?>