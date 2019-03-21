<?php

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

//DBからの問題データを表示用の配列を生成
function formQuestion($small_records){
    foreach($small_records as $record_value){
		$big_que=$record_value["big_questions_id"];
		$big_q=$record_value["big_question"];
		$small_q=$record_value["question"];
		$questions1[$big_que]=["big_question"=>$big_q];
		$questions2[$big_que][]=$small_q;
	}

	for($i=1; $i<=3; $i++ ){
		$questions[$i]=$questions1[$i];
		$questions[$i]["questions"]=$questions2[$i];
	}
    return $questions;
}



//ユーザーの回答内容を含めて、answer.phpで問題と正答を表示させる
function formUserAnswerAndQuestion($small_records){
    foreach($small_records as $record_value){
        $big_que=$record_value["big_questions_id"];
        $big_q=$record_value["big_question"];
        $small_q=$record_value["question"];
        $small_a=$record_value["answer"];
        $questions1[$big_que]=["big_question"=>$big_q];
        $questions2[$big_que][]=$small_q;
        $answers[$big_que][]=$small_a;
    }
    for($i=1; $i<=3; $i++ ){
        $questions[$i]=$questions1[$i];
        $questions[$i]["questions"]=$questions2[$i];
        $questions[$i]["answers"]=$answers[$i];
    }
    return $questions;
}

//ユーザーが保存した問題と答えを保存用の配列に生成
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



//回答履歴表示用のgenre_valueを返す
function hist_genre($hist_detail_arrays){
foreach($hist_detail_arrays as $hist_detail_array){
    }
    return $hist_detail_array["genre_value"];
}

//DBからのデータを履歴詳細表示用の配列に生成する
function HistIndicateDataInit($hist_indicate_datas){
    foreach ($hist_indicate_datas as $hist_indicate_data) {
        $big_que=$hist_indicate_data["big_questions_id"];
        $big_q=$hist_indicate_data["big_question"];
        $small_q = $hist_indicate_data["small_question"];
        $small_a=$hist_indicate_data["answer"];
        $user_a=$hist_indicate_data["user_answer"];
        $user_r=$hist_indicate_data["result"];
        $questions1[$big_que]=["big_question"=>$big_q];
        $questions2[$big_que][]=$small_q;
        $answers[$big_que][]=$small_a;
        $user_answers[$big_que][]=$user_a;
        $user_results[$big_que][]=$user_r;

    }
    for($i=1; $i<=3; $i++ ){
        $hist_indicates[$i]=$questions1[$i];
        $hist_indicates[$i]["questions"]=$questions2[$i];
        $hist_indicates[$i]["answers"]=$answers[$i];
        $hist_indicates[$i]["user_answers"]=$user_answers[$i];
        $hist_indicates[$i]["user_result"]=$user_results[$i];
    }
    return $hist_indicates;
}
