<?php

class Facilities_Ship{

// +------------+---------+------+-----+---------+----------------+
// | Field      | Type    | Null | Key | Default | Extra          |
// +------------+---------+------+-----+---------+----------------+
// | id         | int(11) | NO   | PRI | NULL    | auto_increment |
// | facilities | int(11) | NO   | MUL | NULL    |                |
// | ship       | int(11) | NO   | MUL | NULL    |                |
// +------------+---------+------+-----+---------+----------------+

//attributes 
private $id;
private $facilities;
private $ship;

//Getters
function getID() : int {

   return $this->id;
}

function getFacilities() : int {

    return $this->facilities;
}

function getShip() : int {

    return $this->ship;
}

//Setters
function setID(int $newID) {

    $this->id = $newID;
}

function setFacilities(int $newFacilities){

    $this->facilities = $newFacilities;
}

function setShip(int $newShip){

    $this->ship = $newShip;
}

}
?>