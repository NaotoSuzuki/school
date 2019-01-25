<?php
//genre_phpはindexからrequireしてないけど変数同じだから値をうけとっていて、
//それをここでも使ってるから、indexで値と文字列がひっくり返ってるせいですべてが狂っていた
// require_once("genre_class.php");

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

?>
