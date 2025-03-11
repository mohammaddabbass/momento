<?php 
class PhotoSkeleton {

    public static $user_id;
    public static $title;
    public static $description;
    public static $image_url;
    public static $created_at;

    public static function create($user_id, $title, $description, $image_url, $created_at){
        self::$user_id = $user_id;
        self::$title = $title;
        self::$description = $description;
        self::$image_url = $image_url;
        self::$created_at = $created_at;
    }

}

?>