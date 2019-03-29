<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/Tour.class.php');
require_once('inc/Entities/City.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/ToursMapper.class.php');
require_once('inc/utilities/CitiesMapper.class.php');
require_once('inc/utilities/PDOAgent.class.php');


ToursMapper::initialize();
$tours = ToursMapper::getTours();


PageIndex::header();
PageIndex::showTours($tours);
PageIndex::FormTour('aa');
var_dump($tours);
PageIndex::footer();


?>