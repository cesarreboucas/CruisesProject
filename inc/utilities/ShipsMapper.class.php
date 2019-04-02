<?php

class ShipsMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOAgent('Ships');
    }
    
    /*
    mysql> desc ships;
    +-------------+-------------+------+-----+---------+----------------+
    | Field       | Type        | Null | Key | Default | Extra          |
    +-------------+-------------+------+-----+---------+----------------+
    | id          | int(11)     | NO   | PRI | NULL    | auto_increment |
    | name        | varchar(45) | NO   |     | NULL    |                |
    | yearservice | int(5)      | NO   |     | NULL    |                |
    +-------------+-------------+------+-----+---------+----------------+
    */

    static function createShip(Ships $newShip) {
        $sql = 'insert into Ships(name, yearservice) values (:name, :yearservice)';
        self::$db->query($sql);
        self::$db->bind(':name', $newShip->getShipName());
        self::$db->bind(':yearservice', $newShip->getShipYear());
        self::$db->execute();
        return  self::$db->lastInsertId();
    }

    static function deleteShip(String $id) {
        try {
            $sql = "delete from Ships where id = :id;";
            self::$db->query($sql);
            self::$db->bind(':id', $id);
            self::$db->execute();
            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting Ship");
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    static function getShips() {
        $sql = 'select * from Ships;';
        self::$db->query($sql);
        self::$db->execute();
        return self::$db->resultSet();
    }

}

?>