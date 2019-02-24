
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

//function.phpのformUserResultから$answer_datasを受け取る必要がある
function insertUserAnser($user_datas){
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
            now()
        )";
        foreach ($answer_datas as $answer_data){
            // $stmt = $dbh->prepare();
            // $answer_bind_array = null;
            // $answer_bind_array = array(
            //     "user_id" => $user_id,
            //     "genre_value" => $genre_param,
            //     "big_questions_id" => $answer_data["big_questions_id"],
            //     "question_num" => $answer_data["question_num"],
            //     "user_answer" => $answer_data["user_answer"],
            //     "result" => $answer_data["result"],
            // );
        $stmt=$pdo->prepare($answer_sql);
        // $stmt->bindParam($answer_bind_array);
        // var_dump($answer_sql);
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
            $stmt->execute();
            // $dbh->insertRecord($answer_sql,$answer_bind_array);
        }
    }
     catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }
}
