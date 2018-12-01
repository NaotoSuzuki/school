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

  public function getQuestionRecord($genre){
    $this->sql = "SELECT question_table.question , sentence_table.sentence_1, sentence_table.sentence_2 , sentence_table.sentence_3
      FROM sentence_table inner join question_table
      on sentence_table.question_type = question_table.type where sentence_table.genre = \"$genre\"";

    return $this->getRecord();
  }


}

?>
