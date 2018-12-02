<?php
require_once("genre_classc.php");
class Grammer{
  private $grammerName;
  private $grammerValue;


  public function __construct($grammerValue){

    $this->grammerValue=$grammerValue;
    $grammerList=array(
      'beverb' => 'Be動詞' ,
      'verb'=>'一般動詞',
      'pronoun'=>'代名詞',
      'thirdperson'=>'三人称単数',
      'can'=>'Can',
    );
        $this->grammerName=$grammerList[$grammerValue];
  }

  /**/
  public function getValue(){
  return $this->grammerValue;

  }

  public function getName(){
   return  $this->grammerName;

  }

}
