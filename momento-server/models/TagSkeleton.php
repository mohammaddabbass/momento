<?php 
class TagSkeleton {

    public static $id;
    public static $name;


    public static function create($id, $name){
        self::$id = $id;
        self::$name = $name;

    }

}

?>