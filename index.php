<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/Tour.class.php');
require_once('inc/Entities/City.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/Validation.class.php');
require_once('inc/utilities/ToursMapper.class.php');
require_once('inc/utilities/CitiesMapper.class.php');
require_once('inc/utilities/PDOAgent.class.php');

$errors = array();
ToursMapper::initialize();
$tour = new Tour();

PageIndex::header();

//var_dump($_POST);
if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['id'])) {
    // Validation helps filling tours
    Validation::validateTour($errors, $tour);
    if(empty($errors)) {
        if($_POST['id']==0) {
            $id = ToursMapper::addTour($tour);
            PageIndex::showMessages('Tour '.$id.' added.');
        } else {
            $num = ToursMapper::editTour($tour);
            PageIndex::showMessages($num.' tours were edited.');
        }
    }
    // Creating a empty tour
    $tour = new Tour();
} else {
    if(isset($_GET['a']) && isset($_GET['id'])) {
        switch ($_GET['a']) {
            case 'd':
                //Executing the delete
                $num = ToursMapper::deleteTour($_GET['id']);
                PageIndex::showMessages($num.' tour deleted. (id -> '.$_GET['id'].')');
                break;
            case 'e':
                // Showing edit form
                $tour = ToursMapper::getTour($_GET['id']);
                break;
        }
    }
}
$tours = ToursMapper::getTours();




if(!empty($errors)) {
    PageIndex::showErrors($errors);    
}
PageIndex::showTours($tours);
PageIndex::FormTour($tour);

//var_dump($tours);
PageIndex::footer();


?>