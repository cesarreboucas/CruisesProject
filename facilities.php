<?php

//Config file for databse connection
require_once('inc/config.inc.php');

//Entity
require_once('inc/entities/Facilities.class.php');

//Utilities
require_once('inc/utilities/PDOAgent.class.php');
require_once('inc/utilities/FacilitiesMapper.class.php');
require_once('inc/utilities/PageIndex.class.php');
require_once('inc/utilities/PageFacilities.class.php');
require_once('inc/utilities/Validation.class.php');

//Page Header
PageIndex::header();

//Initialize the Facilities connection
FacilitiesMapper::initialize("Facilities");

//Get request is not empty
if(!empty($_GET)){

    //determine the action based on hidden input
     switch($_GET["action"]){


        //if the delete button is clicked
         case 'delete':

            //find the id assoicated with the action and delete it from the database
            FacilitiesMapper::deleteFacility($_GET["id"]);

            //display message to confirm delete of facility
            PageIndex::showMessages('Facility id->'.$_GET['id'].' removed.');
            break;

        //if the edit button is clicked
         case "edit":

            //find the id assoicated with the action
            $editFacility = FacilitiesMapper::getFacility($_GET["id"]);
            break;
     }
 }

//POST request and it is not empty
if(!empty($_POST)){

    //validate all the inputs
    //Search input is allowed to be empty, only validation will be the items going to the database
    $errors = Validation::validateFacilities();

    //errors are found
    if(!empty($errors)){

        //return messages on missing inputs
        PageIndex::showErrors($errors);

    }else{

        //No errors, we can move on to performing the following actions from hidden input
        //$_POST['post'] ---> hidden input on the forms
        switch($_POST['post']){

            //We are adding a new Facility to the database
            case 'add':

            //create the facility
                $newFacility = new Facilities();
    
            //set the name from the textbox
                $newFacility->setName($_POST["name"]);
                
            //add the facility
                $id = FacilitiesMapper::addFacility($newFacility);

                
            //return a message confirming addition 
                PageIndex::showMessages('Facility id->'.$id. ' added.');
                break;
            
            //Update the Facility based on the get request id from above
            case 'update':

            //create a new Facility Object
                $updateFacility = new Facilities();
    
                //set the ID and the Name
                //ID comes from the hidden input on the edit form
                $updateFacility->setID($_POST["facilityID"]);
                $updateFacility->setName($_POST["name"]);
    
                //Update the Facility where the ID = $_POST["facilityID"] --> hidden input
                FacilitiesMapper::editFacility($updateFacility);
                
                //show a confirmation message for update
                PageIndex::showMessages('Facility id->'.$_POST['facilityID'].' updated.');
                break;
        }
    }
}

    

//get all the facilities information from the database
$facilities = FacilitiesMapper::getFacilities();

//display the information in a table
PageFacilities::showFacilities($facilities);

//if we are editing a facility
if(!empty($_GET) && $_GET['action'] == "edit"){

    //show the edit form with the infomatin in the form fields
    PageFacilities::editFacilitiesForm($editFacility);

}else{

    //display the add form 
    PageFacilities::addFacilitiesForm();
}

//show footer
PageIndex::footer();
?>