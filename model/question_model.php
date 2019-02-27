<?php
require_once("../pdo_class.php");

function QuestiongetRecord($genre_param){
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
