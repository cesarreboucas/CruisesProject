<?php

class Tour {

    // id int NOT NULL AUTO_INCREMENT,
    // sailing_date date DEFAULT NULL,
    // duration int NOT NULL,
    // ship int NOT NULL,
    // from_city int NOT NULL,
    // to_city int NOT NULL,
    // oneway int(1) not null,

    private $id;
    private $sailing_date;
    private $duration;
    private $ship;
    private $from_city;
    private $to_city;
    private $oneway;

    //Getters
    public function getId() : int {
        return $this->id;
    }
    public function getSailingDate()  {
        return $this->sailing_date;
    }
    public function getDuration() : int {
        return $this->duration;
    }
    public function getShip() : int {
        return $this->ship;
    }
    public function getFromCity() : int {
        return $this->from_city;
    }
    public function getToCity() : int {
        return $this->to_city;
    }

    public function getOneway() : int {
        return $this->oneway;
    }

    // Setters
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setSailingDate(String $date)  {
        $this->sailing_date = $date;
    }
    public function setDuration(int $duration) {
        $this->duration = $duration;
    }
    public function setShip(int $ship) {
        $this->ship = $ship;
    }
    public function setFromCity(int $city) {
        $this->from_city = $city;
    }
    public function setToCity(int $city) {
        $this->to_city = $cit;
    }

    public function setOneway(int $ow) {
        $this->oneway = $ow;
    }

}

?>