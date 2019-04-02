<?php

class Ships {

    private $id = 0;
    private $name = "";
    private $yearservice = "";

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
    

    public function setShipID($newID) {
        $this->id = $newID;
    }
    
    public function setShipName($newName) {
        $this->name = $newName;
    }

    public function setShipYear($newYear) {
        $this->yearservice = $newYear;
    }
    
    public function getShipID() {
        return $this->id;
    }

    public function  getShipName() {
        return $this->name;
    }

    public function getShipYear() {
        return $this->yearservice;
    }

}

?>