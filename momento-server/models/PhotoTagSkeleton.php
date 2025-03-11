<?php 
class PhotoTagSkeleton {

    public static $photo_id;
    public static $tag_id;

    public static function create($photo_id, $tag_id){
        self::$photo_id = $photo_id;
        self::$tag_id = $tag_id;
    }

}