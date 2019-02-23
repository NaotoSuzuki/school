<?php

    //questionからの送信先をこのファイルにする必要がある

    class SaveAnsewrs{

        // if (isset($_POST["save"])) {
        //↑これはviewかコントローラー側

        public function formUserAnswer(){
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

        public function insertAnswers(){
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
            }catch(PDOException $e) {
                echo $e->getMessage();
                die();
            }
            echo "結果を保存しました！";

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

    }
