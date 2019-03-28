<?php

class ToursMapper {
    static $db;
    static function initialize() {
        self::$db = new PDOAgent('Tour');
    }

    static function getTours() {
        self::$db->query('select id,sailing_date,ship,duration,from_city,to_city,oneway from tours;');
        self::$db->execute();
        return self::$db->resultSet();
    }
}

?>