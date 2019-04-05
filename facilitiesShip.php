<?php

//Config file for databse connection
require_once('inc/config.inc.php');

//Entity
require_once('inc/entities/Facilities_Ship.class.php');
require_once('inc/entities/Facilities.class.php');


//Utilities
require_once('inc/utilities/PDOAgent.class.php');
require_once('inc/utilities/FacilitiesShipMapper.class.php');


//Include the Mapper for facilites, using the READ function 
//to get all the facilites for the dropdown box
require_once('inc/utilities/FacilitiesMapper.class.php');

//Utilities
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/PageFacilitiesShip.class.php');
require_once('inc/utilities/Validation.class.php');

//Page Header
PageIndex::header();

//Initialize the Classes
FacilitiesShipMapper::initialize("Facilities_Ship");
FacilitiesMapper::initialize("Facilities");


//GET request
if(!empty($_GET)){

    //determine the action based on hidden input
    switch($_GET['action']){

        //if the delete button is clicked
        case 'delete':

        //find the id assoicated with the action and delete it from the database
            $delete = FacilitiesShipMapper::deleteFS($_GET["id"]);

        //display message to confirm delete of facility
            PageIndex::showMessages('Facility id->'.$_GET["id"]. ' removed.');
            break;

        //if the edit button is clicked
        case 'edit':

        //find the id assoicated with the action
            $updateFS = FacilitiesShipMapper::getFS($_GET["id"]);
            break;
    }
}


//POST request
if(!empty($_POST)){

 //validate all the inputs
    $errors = Validation::validateFacilitiesShip();

        //If there are errors...
        if(!empty($errors)){

            //return message showing which fields are missing
            PageIndex::showErrors($errors);
            
        }else{

            //continue with POST request
            //$_POST['post'] ---> hidden input on the forms
            switch($_POST['post']){

                //We are adding a new Facility_Ship to the database
                case 'add':

                //create a Facilities_Ship object
                    $newFS = new Facilities_Ship();
        
                    //set the shipID based on the dropdown value
                    $newFS->setShip($_POST["shipOptions"]);

                    //set the FaciltiesID based on the dropdown value
                    $newFS->setFacilities($_POST["facilityOptions"]);
        
                    //create new ship with the facility
                    $n = FacilitiesShipMapper::addNewFS($newFS);

                    //return confirmation message 
                    PageIndex::showMessages('Facility id->'.$n. ' added.');
                    break;
                
                
                //Update the Facilities_Ship based on the get request id from above
                case 'update':

                //create new Facilities_Ship object
                    $update = new Facilities_Ship();
        
                    //set facilities_Ship id ----> hidden input on form
                    //retrieved from get request when edit button is clicked
                    $update->setID($_POST["fsid"]);

                    //set the facilities id from dropdown box
                    $update->setFacilities($_POST["facilityOptions"]);

                    //set the ship id from the dropdown box
                    $update->setShip($_POST["shipOptions"]);
        
                    //update where the id matches
                    FacilitiesShipMapper::editFS($update);

                    //show message of confirmation
                    PageIndex::showMessages('Facility id->'.$_POST["fsid"]. ' updated.');
                    break;
                    

                //search functionality
                case 'search':

                //Take the post value and display database results similar to that value
                    $search = FacilitiesShipMapper::search($_POST['searchValue']);
                    //var_dump($search);

                    //display the results in a table
                    PageFacilitiesShip::displaySearchResults($search);
                    break;
                }
            }
        }



//get the ship and facilities details for list of ships and their faciltiies
$facilities = FacilitiesShipMapper::getShipFacilities();
//var_dump($facilities);

//get all the facility data from the facility for the dropdown box
$allFacilities = FacilitiesMapper::getFacilities();
//var_dump($allFacilities);

//get all the ships data for the dropdown box
$allShips = FacilitiesShipMapper::selectShips();
//var_dump($allShips);


//display the search form
PageFacilitiesShip::searchForm();


//display the facilities and their corresponding ships
PageFacilitiesShip::displayShipFacilties($facilities);

//if we are editing
if(!empty($_GET) && $_GET['action'] == "edit"){

    //show the edit form with the information in the form fields
        PageFacilitiesShip::editForm($allShips, $allFacilities, $updateFS);
}else{

        //display the add form with dynamic dropdown menus
        PageFacilitiesShip::addForm($allShips, $allFacilities);
}

//show the footer
PageIndex::footer();

?>