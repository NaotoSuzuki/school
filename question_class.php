<?php


/*ここのrequireにgetで文法ごとのphpファイルを読み込ませるんか？*/
class Question{
  private $question;

  public function __construct($question){
    $this->question=$question;
  }

  public function getQuestion(){
    return $this->question;
  }

}



?>
