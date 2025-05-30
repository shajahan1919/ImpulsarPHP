<?php

class homeMdl extends Model{

    var $database;

    public function __Construct(){

        $this->database = $this->load('database','default');

    }

    function serverDetails(){

        return $_SERVER;

    }

    function getCountries(){

        $countries = array();

        $st = $this->database->run("SELECT * FROM countries");

        while($row = $this->database->fetch($st)){
            $countries[] = $row;
        }

        return $countries;

    }

}

?>