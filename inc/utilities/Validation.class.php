<?php

class Validation {
    public static function validateCity($f, &$e) {
        
    }

    public static function validateTour(&$e, & $tour) {
        if(strlen($_POST['sailing']) > 9 ) {
            $sailingDate = @DateTime::createFromFormat('d-M-Y', trim($_POST['sailing']));
            //var_dump($sailingDate);
            if(!$sailingDate) {
                $_POST['sailing'] = '';
            } else {
                $tour->setSailingDate($sailingDate->format("Y-m-d"));
            }
        }
        settype($_POST['ship'],'int');
        if(!is_integer($_POST['ship']) || $_POST['ship']==0 || $_POST['ship']=="0") {
            $e[] = ('Ship information is missing.');
        } else {
            $tour->setShip($_POST['ship']);
        }

        settype($_POST['duration'],'int');
        if(!is_integer($_POST['duration']) || $_POST['duration']==0 || $_POST['duration']=="0") {
            $e[] = ('Duration information is missing.');
        } else {
            $tour->setDuration($_POST['duration']);
        }

        settype($_POST['departure'],'int');
        if(!is_integer($_POST['departure']) || $_POST['departure']==0 || $_POST['departure']=="0") {
            $e[] = ('Departure information is missing.');
        } else {
            $tour->setFromCity($_POST['departure']);
        }

        settype($_POST['destiny'],'int');
        if(!is_integer($_POST['destiny']) || $_POST['destiny']==0 || $_POST['destiny']=="0") {
            $e[] = ('Destiny information is missing.');
        } else {
            $tour->setToCity($_POST['destiny']);
        }
        if(isset($_POST['oneway'])) {
            $tour->setOneway(1);
        }
        settype($_POST['id'],'int');
        if(is_integer($_POST['id']) && $_POST['id']!=0 && $_POST['id']!="0") {
            $tour->setId($_POST['id']);
        }
    }
}

?>