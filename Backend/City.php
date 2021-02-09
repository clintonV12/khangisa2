<?php

class City{
    private $id;
    private $name;
    private $countryID;

    function __construct(){}

    public function setID($id){
        $this->id = $id;
    }

    public function getID(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setCountryID($countryID){
        $this->countryID = $countryID;
    }

    public function getCountryID(){
        return $this->countryID;
    }
}

?>