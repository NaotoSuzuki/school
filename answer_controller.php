<?php
function answerInit($genre_param){
    require_once("answer_model.php");
    return answerGetRecord($genre_param);
}

//値はviewから参照する
function formUserAnswer($results,$user_answer_array,$big_records,$small_records){
    $results=$_POST["result"];
    // var_dump($results);
    $user_answer_array = $_POST["user_answer"];
    foreach ($big_records as $big_value){
        // var_dump($big_records);
        foreach($small_records as $small_value){
            if($big_value["id"]==$small_value["big_questions_id"]){
                    $big_num=$big_value["id"] ;
                    $small_num=$small_value["question_num"];
                    // $small=$small_answers[$big_num][$small_num];
                    $small = $user_answer_array[$big_num][$small_num];
                    $result=$results[$big_num][$small_num];
                    // var_dump($result);
                    $answer_datas[]=["user_id"=>$user_id, "genre_value"=>$genre_param, "big_questions_id"=>$big_num,"question_num"=>$small_num, "user_answer"=>$small ,"result"=>$result];
            }
        }
    }
}
