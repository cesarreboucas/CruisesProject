<?php

class Attractions {

    private $id;
    private $name;
    private $tour;

    public function setAttractionID($newID) {
        $this->id = $newID;
    }

    public function setAttractionName($newName) {
        $this->name = $newName;
    }

    public function setAttractionTour($newTour) {
        $this->tour = $newTour;
    }

    public function getAttractionID() {
        return $this->id;
    }

    public function getAttractionName() {
        return $this->name;
    }

    public function getAttractionTour() {
        return $this->tour;
    }
}

?>