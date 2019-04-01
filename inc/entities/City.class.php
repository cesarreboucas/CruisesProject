<?php

class City {
    private $id = 0;
    private $name = "";

    public function getId() : int {
        return $this->id;
    }
    public function getName() : String {
        return $this->name;
    }

    public function setId(int $id) {
        $this->id = $id;
    }
    public function setName(String $name) {
        $this->name = $name;
    }
}

?>