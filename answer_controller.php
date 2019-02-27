<?php
function answerInit($genre_param){
    require_once("answer_model.php");
    return answerGetRecord($genre_param);
}


function formUserAnswer($user_id,$genre_param,$results,$user_answer_array,$big_records,$small_records){
    foreach ($big_records as $big_value){
        foreach($small_records as $small_value){
            if($big_value["id"]==$small_value["big_questions_id"]){
                    $big_num=$big_value["id"] ;
                    $small_num=$small_value["question_num"];
                    $small = $user_answer_array[$big_num][$small_num];
                    $result=$results[$big_num][$small_num];
                    $answer_datas[]=["user_id"=>$user_id, "genre_value"=>$genre_param, "big_questions_id"=>$big_num,"question_num"=>$small_num, "user_answer"=>$small ,"result"=>$result];
            }
        }
    }
    return $answer_datas;
}
