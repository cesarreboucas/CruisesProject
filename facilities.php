<?php

require_once('inc/config.inc.php');

//Entity
require_once('inc/entities/Facilities.class.php');

//Utilities
require_once('inc/utilities/PDOAgent.class.php');
require_once('inc/utilities/FacilitiesMapper.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/PageFacilities.class.php');
require_once('inc/utilities/Validation.class.php');

PageIndex::header();

FacilitiesMapper::initialize("Facilities");

if(!empty($_GET)){
     switch($_GET["action"]){
         case 'delete':

            FacilitiesMapper::deleteFacility($_GET["id"]);
            break;

         case "edit":
            $editFacility = FacilitiesMapper::getFacility($_GET["id"]);
            //var_dump($editFacility);
            break;
     }
 }


if(!empty($_POST)){

    $errors = Validation::validateFacilities();

    if(!empty($errors)){

        PageIndex::showErrors($errors);

    }else{

        switch($_POST['post']){
            case 'add':
                $newFacility = new Facilities();
    
                $newFacility->setName($_POST["name"]);
    
                FacilitiesMapper::addFacility($newFacility);
                break;
            
            case 'update':
                $updateFacility = new Facilities();
    
                $updateFacility->setID($_POST["facilityID"]);
                $updateFacility->setName($_POST["name"]);
                $updateFacility->setActive($_POST["active"]);
    
                FacilitiesMapper::editFacility($updateFacility);
                break;
        }
    }
}

    


$facilities = FacilitiesMapper::getFacilities();
PageFacilities::showFacilities($facilities);


if(!empty($_GET) && $_GET['action'] == "edit"){

    PageFacilities::editFacilitiesForm($editFacility);
}else{

    PageFacilities::addFacilitiesForm();
}

PageFacilities::facilitiiesFooter();
?>