<?php

class mysqlClass{

  private $dbh;
  private $sql;
  public function __construct(){
    $user = "test";
    $pass = "test";
    $this->dbh =new PDO('mysql:host=localhost;dbname=grammer_answers;charset=utf8', $user, $pass);
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
    $this->sql = "SELECT question_table.question , answer_table.sentence_1, answer_table.sentence_2 , answer_table.sentence_3
      FROM sentence_table inner join question_table
      on answer_table.question_type = question_table.type where answer_table.genre = \"$genre\"";

    return $this->getRecord();
  }


}

?>
