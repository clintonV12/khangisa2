<?php

class Country{
    private $id;
    private $name;
    private $currency;

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

    public function setCurrency($currency){
        $this->currency = $currency;
    }

    public function getCurrency(){
        return $this->currency;
    }
}

?>