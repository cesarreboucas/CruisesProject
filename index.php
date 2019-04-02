<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/Tour.class.php');
require_once('inc/Entities/City.class.php');
require_once('inc/Entities/Facilities.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/Validation.class.php');
require_once('inc/utilities/ToursMapper.class.php');
require_once('inc/utilities/CitiesMapper.class.php');
require_once('inc/utilities/FacilitiesMapper.class.php');
require_once('inc/utilities/PDOAgent.class.php');
session_start();

$filters = array();
if(isset($_GET['filter'])) {
    if(isset($_SESSION['filter'][$_GET['filter']])==false) {
        $_SESSION['filter'][$_GET['filter']] = 0;
    }
    if(isset($_GET['addfilter'])) {
        $_SESSION['filter'][$_GET['filter']] = $_GET['addfilter'];
        $filters = $_SESSION['filter'];

    } else if($_GET['filter']=="none") {
        unset($_SESSION);
        session_destroy();
        $filters = array();
    }    
}

/**/

$errors = array();
ToursMapper::initialize();
$tour = new Tour();

PageIndex::header();

CitiesMapper::Initialize();
$cities = CitiesMapper::getCities();

FacilitiesMapper::Initialize('Facilities');
$facilities = FacilitiesMapper::getFacilities();

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

if(isset($_SESSION['filter'])) {
    $filters = $_SESSION['filter'];
}
//var_dump($filters);
$tours = ToursMapper::getTours($filters);

if(!empty($errors)) {
    PageIndex::showErrors($errors);    
}

PageIndex::showTours($tour, $tours, $cities, $facilities);
//PageIndex::FormTour($tour, $cities);

//var_dump($tours);
PageIndex::footer();


?>