<?php

class geoinfoMdl extends Model{

    var $database;

    public function __Construct(){

        $this->database = $this->load('database','default');

    }

    function getCountries(){

        $statement = $this->database->table("countries");

        $statement->select('*');

        $statement->orderBy('Country ASC');

        $statement->limit('0,175');

        $statement->fetch();   

        $result = $statement->getStatus();

        return $result;

    }

    function getRegions($CountryID=0){

        $statement = $this->database->table("regions");

        $statement->select('*');

        $statement->where('CountryId',$CountryId);

        $statement->orderBy('Region ASC');

        $statement->limit('0,175');

        $statement->fetch();

        $result = $statement->getStatus();

        return $result;


        function getCities($RegionID,$CountryID=0){

            $statement = $this->database->table("cities");
    
            $statement->select('*');

            if($CountryID>0){

                $statement->where('CountryId',$CountryId);

            }

            $statement->where('RegionID',$RegionID);
            
    
            $statement->orderBy('City ASC');
            
            $statement->limit('0,175');
            
            $statement->fetch();

    
            $result = $statement->getStatus();
    
            return $result;
    
        }
    }

}

?>