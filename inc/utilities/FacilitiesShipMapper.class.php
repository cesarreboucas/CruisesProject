<?php

class FacilitiesShipMapper{

    static private $db;

    static function initialize(string $className){

        self::$db = new PDOAgent($className);
    }


    /*///////////////////////////////////////////////////////////////////////////
    /*                                                                        */
    /*     The two functions below pull values from joining tables           */
    /*                                                                      */
    ///////////////////////////////////////////////////////////////////////*/

    ////////////// READ - FOR FACILITIES ///////////////
    //retrieve all the facilities and ships from the database where their ids match in both tables,
    //display the ships and the facilties that they have
    static function getShipFacilities() : Array {

        $select = "select   fs.id as id, s.id as ship, s.name as shipName, s.yearservice, f.name as facilityName, f.id as facilities
                            from ships s 
                            JOIN facilities_ship fs ON fs.ship = s.id
                            JOIN facilities f ON f.id = fs.facilities
                            ";

        self::$db->query($select);
        self::$db->execute();

        return self::$db->resultSet();
    }

    ////////////// READ - FOR SHIPS VALUES ///////////////
    //get all the ships from the ships table for the dropdown box
    static function selectShips() : Array {

        $dropboxSelect = "SELECT DISTINCT s.name as shipName, s.id as ship
                                    FROM ships s";

        self::$db->query($dropboxSelect);
        self::$db->execute();

        return self::$db->resultSet();
    }



    ////////////// CREATE ///////////////
    //add a new facility to a ship
    static function addNewFS(Facilities_Ship $fs) : int {

        $sqlInsert = "INSERT INTO facilities_ship (ship, facilities)
                                                    VALUES (:shipID, :facilityID)";

        self::$db->query($sqlInsert);
        self::$db->bind(":shipID", $fs->getShip());
        self::$db->bind(":facilityID", $fs->getFacilities());
        self::$db->execute();

        return self::$db->lastInsertId();

    }

    ////////////// READ ///////////////
    //retrieve the selected ship facility based on the id
    static function getFS(int $id) {

        $select = "select   fs.id, s.id as ship, s.name as shipName, f.id as facilities, f.name as facilityName
                            from ships s 
                            JOIN facilities_ship fs ON fs.ship = s.id
                            JOIN facilities f ON f.id = fs.facilities
                            WHERE fs.id = :fsid";

        self::$db->query($select);
        self::$db->bind(":fsid", $id);
        self::$db->execute();
        return self::$db->singleResult();
    }


    ////////////// UPDATE ///////////////
    //edit a current facility attached to the ship
      static function editFS(Facilities_Ship $fs) : bool {

          $update = "UPDATE facilities_ship SET facilities =:updateFacilitiesID,
                                                ship = :updateShipID
                                            WHERE id = :updateID";
            try
            {
                
            self::$db->query($update);

                    
            self::$db->bind(":updateShipID", $fs->getShip());
            self::$db->bind(":updateFacilitiesID", $fs->getFacilities());
            self::$db->bind(":updateID", $fs->getID());

            self::$db->execute();

                
                if(self::$db->rowCount() != 1){
                    throw new Exception("Problem updating from database");
                }

            }catch(Exception $ex){
                echo $ex->getMessage();
                self::$db->debugDumpParams();
                return false;
            }

            //return the rowcount
            return self::$db->rowCount();
            }


        ////////////// DELETE ///////////////
        //Delete a facility and ship relationship
            static function deleteFS(int $id) : bool {

                $delete = "DELETE FROM facilities_ship WHERE id = :id";

                try{
                    self::$db->query($delete);
                    self::$db->bind(":id", $id);
                
                    self::$db->execute();
                
                    if(self::$db->rowCount() != 1){
                
                        throw new Exception("Problem deleting ship facility $id");
                        }
                        
                    }catch(Exception $ex){
                        echo $ex->getMessage();
                        self::$db->debugDumpParam();
                        return false;
                    }
                    return true;
            }

            ////////////// SEARCH FUNCTIONALITY ///////////////
            //search for a facility and show what ships have that facility
            //if customer is looking for specific facilities such as a Pool
            //they would choose a cruise/tour the facilities to their liking
            static function search(string $facility) : Array {

                $searchValue = "%$facility%";

                $select = 'select  fs.id as id, s.id as shipID, s.name as shipName, s.yearservice, f.name as facilityName
                                from ships s 
                                JOIN facilities_ship fs ON fs.ship = s.id
                                JOIN facilities f ON f.id = fs.facilities
                                WHERE f.name LIKE :facility
                                ORDER BY s.name
                            ';

                    self::$db->query($select);
                    self::$db->bind(":facility", $searchValue);
                    self::$db->execute();

                    return self::$db->resultSet();

            }


}



?>