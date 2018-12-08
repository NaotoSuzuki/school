<?php
 require_once("genre_data.ph");
  class Genre{
  private $grammerName;
  private $grammerValue;

  public function __construct($grammer,$grammerValue){

    $this->grammerName=$grammer;
    $this->grammerValue=$grammerValue;

  }

  /**/
  public function getValue(){
  return $this->grammerValue;

  }

  public function getName(){
   return  $this->grammerName;


  }

}
