<?php
session_start();
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

// $sql = null;
// $res = null;
// $dbh = null;
//
//     //答えページの問題と回答を表示させる
// try {
//     // DBへ接続
//     $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
//
//     $sql = "SELECT * FROM big_questions;";
//     $res = $dbh->query($sql);
//     $big_records = $res->fetchAll(PDO::FETCH_ASSOC);
//
//     $sql = "SELECT
//         big_questions.question AS big_question,
//         small_questions.big_questions_id,
//         small_questions.question_num,
//         small_questions.question,
//         answer
//         FROM small_questions
//         inner join big_questions on small_questions.big_questions_id = big_questions.id
//         where  genre_value = :genre_value
//         order by big_questions_id asc, question_num asc";
//
//     $newsql = $dbh->prepare($sql);
//
//     $newsql ->bindparam(':genre_value', $genre_param);
//     $newsql ->execute();
//     $small_records = $newsql->fetchAll(PDO::FETCH_ASSOC);
//
//
    //
class IndicateRsult{
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
}
// } catch(PDOException $e) {
//     echo $e->getMessage();
//     die();
// }

class FormAnswerClass{
    //ユーザーの回答を保存する機能
    if (isset($_POST["save"])) {
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
}
