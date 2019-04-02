<?php

require_once('inc/config.inc.php');
require_once('inc/entities/Attractions.class.php');
require_once('inc/entities/Tour.class.php');
require_once('inc/utilities/PDOAgent.class.php');
require_once('inc/utilities/AttractionsMapper.class.php');
require_once('inc/utilities/ToursMapper.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/PageAttractions.class.php');

AttractionsMapper::initialize();
$attraction = new Attractions();
if(!empty($_GET)) {
    if($_GET['act']=='delete') {
        AttractionsMapper::deleteAttraction($_GET['attractionID']);
    } else if ($_GET['act']=='edit') {
        $attraction = AttractionsMapper::getAttraction($_GET['attractionID']);
        var_dump($attraction);
    } 
} else if(!empty($_POST)) {
    $na = new Attractions();
    $na->setAttractionName($_POST['attraction']);
    $na->setAttractionTour($_POST['tour']);
    settype($_POST['attractionID'], 'int');
    $na->setAttractionID($_POST['attractionID']);

    if($_POST['attractionID'] == 0)
        AttractionsMapper::createAttraction($na);
    else
        AttractionsMapper::updateAttraction($na);
}

$attractions = AttractionsMapper::getAttractions();

PageIndex::header();
PageAttractions::showAttractions($attractions);
PageAttractions::showAttractionForm($attraction);
PageIndex::footer();

?>