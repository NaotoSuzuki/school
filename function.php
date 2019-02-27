<?php
require_once("pdo_class.php");
require_once("answer_controller.php");
$results=$_POST["result"];
$small_answers=$_POST["small_answers"];
$genre_param = $_GET['name'];
// var_dump($_SESSION["ID"]);
$user_id=$_SESSION["ID"];

$records=answerInit($genre_param);
$big_records = $records[0];
$small_records = $records[1];

function formQuestion($small_records){
    foreach($small_records as $record_value){
		$big_que=$record_value["big_questions_id"];
		$big_q=$record_value["big_question"];
		$small_q=$record_value["question"];
		$questions1[$big_que]=["big_question"=>$big_q];
		$questions2[$big_que][]="$small_q";
	}

	for($i=1; $i<=3; $i++ ){
		$questions[$i]=$questions1[$i];
		$questions[$i]["questions"]=$questions2[$i];
	}
    return $questions;
}



    //ユーザーの回答内容を含めて、answer.phpで問題と正答を表示させる
function formUser($small_records){
    foreach($small_records as $record_value){
        $big_que=$record_value["big_questions_id"];
        $big_q=$record_value["big_question"];
        $small_q=$record_value["question"];
        $small_a=$record_value["answer"];
        $questions1[$big_que]=["big_question"=>$big_q];
        $questions2[$big_que][]="$small_q";
        $answers[$big_que][]="$small_a";
    }
    for($i=1; $i<=3; $i++ ){
        $questions[$i]=$questions1[$i];
        $questions[$i]["questions"]=$questions2[$i];
        $questions[$i]["answers"]=$answers[$i];
    }

    return $questions;
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



//user_answerテーブルにinsertするためのデータを格納した配列を作成する

function formUserResult(){
    // var_dump($user_id);
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
