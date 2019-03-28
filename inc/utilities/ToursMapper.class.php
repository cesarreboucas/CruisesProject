<?php

class ToursMapper {
    static $db;
    static function initialize() {
        self::$db = new PDOAgent('Tour');
    }

    static function getTours() {
        self::$db->query('select t.id,t.sailing_date,t.ship,t.duration,t.from_city,t.to_city,
                t.oneway, c.name as to_city_name, ci.name as from_city_name, s.name as ship_name
            from tours t
            inner join cities c on c.id = t.to_city
            inner join cities ci on ci.id = t.from_city
            inner join ships s on s.id = t.ship ;');
        self::$db->execute();
        return self::$db->resultSet();
    }
}

?>