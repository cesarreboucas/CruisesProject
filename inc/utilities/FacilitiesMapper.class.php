<?php

class FacilitiesMapper{

    //instantiate variable to hold db object
    static private $db;

    //create the connection
    public static function initialize(string $className){

        self::$db = new PDOAgent($className);

    }

    ////////////// READ ///////////////
    //get all facilities from the database
    static function getFacilities() : Array {

        $sqlSelect = "SELECT * FROM Facilities;";

        //query
        self::$db->query($sqlSelect);

        //execute
        self::$db->execute();

        //return
        return self::$db->resultSet();
    }


     ////////////// READ ///////////////
    //get single result from databased deteremined by id
    static function getFacility(int $id) {

        $selectOne = "SELECT * FROM Facilities
                                    WHERE id = :id";

        self::$db->query($selectOne);
        self::$db->bind(":id", $id);
        self::$db->execute();

        return self::$db->singleResult();
    }


     ////////////// CREATE ///////////////
    //add a new facility to the database
    static function addFacility(Facilities $facility) : int {

        $sqlInsert = "INSERT INTO facilities (name)
                                    VALUES (:name)";

        self::$db->query($sqlInsert);
        self::$db->bind(":name", $facility->getName());
        self::$db->execute();

        return self::$db->lastInsertId();
    }


     ////////////// UPDATE ///////////////
    //edit a facility currently in the database
    static function editFacility(Facilities $facility) : bool {

        $sqlUpdate = "UPDATE facilities SET name = :updateName
                                            WHERE id = :updateID";

        try{

            self::$db->query($sqlUpdate);

          
            self::$db->bind(":updateName", $facility->getName());
            self::$db->bind(":updateID", $facility->getID());

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
    //delete a facility from the database
    static function deleteFacility(int $id) : bool {

        $sqlDelete = "DELETE FROM facilities WHERE id = :id";

        try{
            self::$db->query($sqlDelete);
            self::$db->bind(":id", $id);
        
            self::$db->execute();
        
            if(self::$db->rowCount() != 1){
        
                throw new Exception("Problem deleting book $id");
                }
                
            }catch(Exception $ex){
                echo $ex->getMessage();
                self::$db->debugDumpParam();
                return false;
            }
            return true;
    }
}

?>