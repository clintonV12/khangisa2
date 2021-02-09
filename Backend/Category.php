<?php

class Category{
    private $id;
    private $name;
    private $parentCategoryID;
    private $maxImages;
    private $postValidityInDays;

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

    public function setParentCategoryID($parentCategoryID){
        $this->parentCategoryID = $parentCategoryID;
    }

    public function getparentCategoryID(){
        return $this->parentCategoryID;
    }

    public function setMaxImages($maxImages){
        $this->maxImages = $maxImages;
    }

    public function getMaxImages(){
        return $this->maxImages;
    }

    public function setPostValidityInDays($postValidityInDays){
        $this->postValidityInDays = $postValidityInDays;
    }

    public function getPostValidityInDays(){
        return $this->postValidityInDays;
    }
}
?>