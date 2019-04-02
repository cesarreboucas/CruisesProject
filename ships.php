<?php

require_once('inc/config.inc.php');
require_once('inc/utilities/PageIndex.class.php');
require_once("inc/entities/Ships.class.php");
require_once("inc/utilities/PDOAgent.class.php");
require_once("inc/utilities/ShipsMapper.class.php");
require_once("inc/utilities/PageShips.class.php");

ShipsMapper::initialize();

if (!empty($_GET))  {
    if ($_GET["act"] == "delete")    {
        ShipsMapper::deleteShip($_GET["shipID"]);
    }
}

//Process any post data
if (!empty($_POST)) {
    //Assemble the Ship
    $ns = new Ships;
    $ns->setShipName($_POST["name"]);
    $ns->setShipYear($_POST["year"]);

    //Add the Ship to the database
    ShipsMapper::createShip($ns);
}

$ships = ShipsMapper::getShips();

PageIndex::header();
PageShips::showShips($ships);
PageShips::showShipsForm();
PageIndex::footer();

?>