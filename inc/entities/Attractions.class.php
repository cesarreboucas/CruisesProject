<?php

class Attractions {

    private $id = 0;
    private $attraction = "";
    private $tour = 0;

    private $shipName;
    private $sailing_date;

    /*
    mysql> desc attractions;
    +------------+-------------+------+-----+---------+----------------+
    | Field      | Type        | Null | Key | Default | Extra          |
    +------------+-------------+------+-----+---------+----------------+
    | id         | int(11)     | NO   | PRI | NULL    | auto_increment |
    | attraction | varchar(30) | NO   |     | NULL    |                |
    | tour       | int(11)     | NO   | MUL | NULL    |                |
    +------------+-------------+------+-----+---------+----------------+
    */

    public function setAttractionID($newID) {
        $this->id = $newID;
    }

    public function setAttractionName($newName) {
        $this->attraction = $newName;
    }

    public function setAttractionTour($newTour) {
        $this->tour = $newTour;
    }

    public function getAttractionID() {
        return $this->id;
    }

    public function getAttractionName() {
        return $this->attraction;
    }

    public function getAttractionTour() {
        return $this->tour;
    }

    public function getShipName() {
        return $this->shipName;
    }

    public function getFormatedSailingDate() : String {
        $date = @DateTime::createFromFormat("Y-m-d", $this->sailing_date );
        if($date) {
            return $date->format('d-M-Y');
        } else {
            return 'Unavailable';
        }
    }

}
?>