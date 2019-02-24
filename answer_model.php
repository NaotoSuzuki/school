<?php
require_once("pdo_class.php");
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


    function formUserAnswer(){
        $results=$_POST["result"];
        $user_answer_array = $_POST["user_answer"];

        foreach ($big_records as $big_value){
            foreach($small_records as $small_value){
                if($big_value["id"]==$small_value["big_questions_id"]){
                    $big_num=$big_value["id"] ;
                        $small_num=$small_value["question_num"];
                        // $small=$small_answers[$big_num][$small_num];
                        $small = $user_answer_array[$big_num][$small_num];
                        $result=$results[$big_num][$small_num];
                        $answer_datas[]=["user_id"=>$user_id, "genre_value"=>$genre_param, "big_questions_id"=>$big_num,"question_num"=>$small_num, "user_answer"=>$small ,"result"=>$result];
                }
            }
        }
        return $answer_datas;
    }


    //ユーザーの回答結果をDBに保存
    function insertAnswers(){
            try {
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
                    now()
                )";
            }

            catch (Exception $e) {
           echo $e->getMessage();
           die();
       }


            foreach ($answer_datas as $answer_data){
                // $stmt = $dbh->prepare();
                $answer_bind_array = null;
                $answer_bind_array = array(
                    "user_id" => $user_id,
                    "genre_value" => $genre_param,
                    "big_questions_id" => $answer_data["big_questions_id"],
                    "question_num" => $answer_data["question_num"],
                    "user_answer" => $answer_data["user_answer"],
                    "result" => $answer_data["result"],
                );

                $dbh->insertRecord($answer_sql,$answer_bind_array);
            }


    }
