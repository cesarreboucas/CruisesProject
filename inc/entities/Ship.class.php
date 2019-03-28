<?php

class Ships {

    private $id;
    private $name;
    private $yearService;

    public function setShipID($newID) {
        $this->id = $newID;
    }
    
    public function setShipName($newName) {
        $this->name = $newName;
    }

    public function setShipYear($newyear) {
        $this->yearservice = $newyear;
    }
    
    public function getShipID() {
        return $this->id;
    }

    public function  getShipName() {
        return $this->name;
    }

    public function getShipYear() {
        return $this->$yearService;
    }

}

?>