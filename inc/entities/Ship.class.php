<?php

class Ships {

    private $id;
    private $name;

    public function setShipID($newID) {
        $this->id = $newID;
    }
    
    public function setShipName($newName) {
        $this->name = $newName;
    }
    
    public function getShipID() {
        return $this->id;
    }

    public function  getShipName() {
        return $this->name;
    }
}

?>