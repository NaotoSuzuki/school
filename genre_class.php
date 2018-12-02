<?php
 require_once("pdo_class.php");
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
