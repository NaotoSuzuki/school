<?php
require_once("../pdo_class.php");
require_once("../controller/answer_controller.php");

//answer.phpの問題表示ように存在している。questionと全く同じコード・・・
function answerGetRecord($genre_param){
    $dbh = new PdoClass();
    try {
    	$big_sql = "SELECT * FROM big_questions";
    	$big_bind_array = [];
    	$big_records=$dbh->getRecord($big_sql,$big_bind_array);
    	// var_dump($big_records);
    } catch (Exception $e) {
    	echo "big:".$e->getMessage();
    }
    try {
    	$small_sql = "SELECT
            big_questions.question AS big_question,
            small_questions.big_questions_id,
            small_questions.question_num,
            small_questions.question,
            answer
            FROM small_questions
            inner join big_questions on small_questions.big_questions_id = big_questions.id
            where  genre_value = :genre_value
            order by big_questions_id asc, question_num asc";
    	$small_bind_array = array('genre_value' => $genre_param);
    	$small_records = $dbh->getRecord($small_sql,$small_bind_array);
    	// var_dump($small_records);
    } catch (Exception $e) {
    	echo "small:".$e->getMessage();
    }
    $records = [$big_records,$small_records];
    return $records;

}


//PdoClassを利用した形に書き直さねば
function insertUserAnwser($answer_datas){
    try {
         $pdo = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
        $answer_sql = "INSERT INTO users_answer (
            user_id,
            genre_value,
            big_questions_id,
            question_num,
            user_answer,
            result,
            created
        ) VALUES (
            :user_id,
            :genre_value,
            :big_questions_id,
            :question_num,
            :user_answer,
            :result,
            :created
        )";

        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        foreach ($answer_datas as $answer_data){
            $stmt=$pdo->prepare($answer_sql);
            $user_id=$answer_data["user_id"];
            $genre_param=$answer_data["genre_value"];
            $big_ID=$answer_data["big_questions_id"];
            $question_num=$answer_data["question_num"];
            $user_answer=$answer_data["user_answer"];
            $result=$answer_data["result"];
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":genre_value", $genre_param);
            $stmt->bindParam(":big_questions_id", $big_ID);
            $stmt->bindParam(":question_num", $question_num);
            $stmt->bindParam(":user_answer", $user_answer);
            $stmt->bindParam(":result", $result);
            $stmt->bindParam(":created", $date);
            $stmt->execute();
            // $dbh->insertRecord($answer_sql,$answer_bind_array);
        }
    }
     catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }
}
