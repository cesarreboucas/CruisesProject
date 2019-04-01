<?php

class Facilities{

// +--------+-------------+------+-----+---------+----------------+
// | Field  | Type        | Null | Key | Default | Extra          |
// +--------+-------------+------+-----+---------+----------------+
// | id     | int(11)     | NO   | PRI | NULL    | auto_increment |
// | name   | varchar(45) | NO   |     | NULL    |                |
// | active | tinyint(1)  | NO   |     | 1       |                |
// +--------+-------------+------+-----+---------+----------------+

//attributes
private $id;
private $name;
private $active;

//Getters
function getID() : int {

    return $this->id;
}

function getName() : string {

    return $this->name;
}

function getActive() : int {

    return $this->active;
}

//Setters
function setID(int $newID) {

    $this->id = $newID;
}

function setName (string $newName) {

    $this->name = $newName;
}

function setActive(int $newActive) {

    $this->active = $newActive;
}

}



?>