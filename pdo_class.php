<?php

class mysqlClass{

  private $dbh;
  private $sql;
  public function __construct(){
    $user = "test";
    $pass = "test";
    $this->dbh =new PDO('mysql:host=localhost;dbname=grammer_questions;charset=utf8', $user, $pass);
  }

  private function getRecord(){

    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $this->dbh->query($this->sql);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->closePDO();
    // print_r($questions);
    return $records;
  }

  private function closePDO(){
    $this->dbh = null;
  }

//DBへの命令。
//$genreの値はquesion.phpでGETされたものが引数で渡される。
  public function getQuestionRecord($genre){
    $this->sql = "SELECT question_table.question , sentence_table.sentence_1, sentence_table.sentence_2 , sentence_table.sentence_3
      FROM sentence_table inner join question_table
      on sentence_table.question_type = question_table.type where sentence_table.genre = \"$genre\"";

    return $this->getRecord();
    //question.phpにて$getquestionclassに代入されている
  }

  public function getAnswerRecord($genre){
    $this->sql =
    "SELECT
    question_table.question ,
    sentence_table.sentence_1 ,
    answer_table.sentence_1 as answer_1 ,
    sentence_table.sentence_2 ,
    answer_table.sentence_2 as answer_2 ,
    sentence_table.sentence_3 ,
    answer_table.sentence_3 as answer_3 
    FROM question_table
    inner join sentence_table
    on question_table.type = sentence_table.question_type
    left join answer_table
    on question_table.type = answer_table.question_type
    where sentence_table.genre = \"$genre\"";

    return $this->getRecord();

  }


}

?>
