<?php

require_once('inc/config.inc.php'); // Config
require_once('inc/Entities/Tour.class.php'); // Main Entiti
require_once('inc/Entities/City.class.php'); // Filter
require_once('inc/Entities/Ships.class.php'); // Filter
require_once('inc/Entities/Facilities.class.php'); // Filter
require_once('inc/Entities/Attractions.class.php'); // Filter
require_once('inc/utilities/PageIndex.class.php'); // Page
require_once('inc/utilities/Validation.class.php'); // Validation
require_once('inc/utilities/ToursMapper.class.php'); // Main Entity Support
require_once('inc/utilities/CitiesMapper.class.php'); // Filter Support
require_once('inc/utilities/AttractionsMapper.class.php'); // Filter Support
require_once('inc/utilities/ShipsMapper.class.php'); // Filter Support
require_once('inc/utilities/FacilitiesMapper.class.php'); // Filter Support
require_once('inc/utilities/StatsMapper.class.php'); // Stats (StdClass)
require_once('inc/utilities/PDOAgent.class.php'); // PDO, Finally :)
session_start();

// Filters Array
$filters = array();
if(isset($_GET['filter'])) {
    // Creating the filter if it has not been set before.
    if(isset($_SESSION['filter'][$_GET['filter']])==false) {
        $_SESSION['filter'][$_GET['filter']] = 0;
    }
    // Setting the filter to the id Example: $_SESSION['filter']['Ship'] = 2
    if(isset($_GET['addfilter'])) {
        $_SESSION['filter'][$_GET['filter']] = $_GET['addfilter'];
        $filters = $_SESSION['filter'];

    // When the "Clear Filter Button" is clicked
    } else if($_GET['filter']=="none") {
        unset($_SESSION);
        session_destroy();
        $filters = array();
    }    
}

$errors = array();
PageIndex::header();

ToursMapper::initialize();
$tour = new Tour();

// Initializing mappers to filters
CitiesMapper::Initialize();
$cities = CitiesMapper::getCities();

FacilitiesMapper::Initialize('Facilities');
$facilities = FacilitiesMapper::getFacilities();

ShipsMapper::Initialize();
$ships = ShipsMapper::getShips();

AttractionsMapper::Initialize();
$attractions = AttractionsMapper::getAttractions();



if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['id'])) {
    // Validation helps filling tours
    Validation::validateTour($errors, $tour);
    if(empty($errors)) {
        if($_POST['id']==0) {
            // Executing Add
            $id = ToursMapper::addTour($tour);
            PageIndex::showMessages('Tour '.$id.' added.');
        } else {
            // Executing Edit
            $num = ToursMapper::editTour($tour);
            PageIndex::showMessages($num.' tour edited.');
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

// Retrieving the tours
$tours = ToursMapper::getTours($filters);

// Showing Errors
if(!empty($errors)) {
    PageIndex::showErrors($errors);    
}

//Getting stats of departure
StatsMapper::initialize();
$stats = StatsMapper::getDateProjection();

// Showing Tours and Filters
PageIndex::showTours($tour, $tours, $cities, $facilities, $ships, $attractions, $stats);
PageIndex::MarkFilters($filters);


PageIndex::footer();


?>