<?php

class CitiesMapper {
    
    static private $db;
    
    public static function initialize() {
        self::$db = new PDOAgent('City');
    }
    // Get all cities
    public static function getCities() : Array {
        self::$db->query('select id, name from cities where active = 1 order by name;');
        self::$db->execute();
        return self::$db->resultSet();
    }
    // Get Single City
    public static function getCity(int $id) : City {
        self::$db->query('select id, name from cities where id = :id limit 1 ;');
        self::$db->bind(':id', $id);
        self::$db->execute();
        return self::$db->singleResult();
    }
    // Add City
    public static function addCity(City $c) : int {
        self::$db->query('insert into cities (name) values (:name);');
        self::$db->bind(':name', $c->getName());
        self::$db->execute();
        return self::$db->lastInsertId();
    }
    // Editi City
    public static function editCity(City $c) : int {
        self::$db->query('update cities set name = :name, active=true where id= :id;');
        self::$db->bind(':name', $c->getName());
        self::$db->bind(':id', $c->getId());
        self::$db->execute();
        return self::$db->rowCount();
    }
    // Delete City
    public static function deleteCity(int $id) : int {
        self::$db->query('update cities set active=false where id= :id;');
        self::$db->bind(':id', $id);
        self::$db->execute();
        return self::$db->rowCount();
    }


}

?>