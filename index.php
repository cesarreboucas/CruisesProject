<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/Tour.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/ToursMapper.class.php');
require_once('inc/utilities/PDOAgent.class.php');


ToursMapper::initialize();
$tours = ToursMapper::getTours();

PageIndex::header();
var_dump($tours);

?>