<?php

function questionInit($genre_param){
    require_once("question_model.php");
    return QuestiongetRecord($genre_param);

}

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
