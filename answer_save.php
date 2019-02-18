<?php
try {
    // DBへ接続

    $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

    foreach ($answer_datas as $answer_data){

        $stmt = $dbh->prepare("INSERT INTO users_answer (user_id, genre_value, big_questions_id ,question_num ,user_answer ,result ,created) VALUES (:user_id, :genre_value, :big_questions_id ,:question_num ,:user_answer, :result ,now() )");

        $big_ID=$answer_data["big_questions_id"];
        $question_num=$answer_data["question_num"];
        $user_answer=$answer_data["user_answer"];
        $result=$answer_data["result"];

        $user_id=$_SESSION["ID"];

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":genre_value", $genre_param);
        $stmt->bindParam(":big_questions_id", $big_ID);
        $stmt->bindParam(":question_num", $question_num);
        $stmt->bindParam(":user_answer", $user_answer);
        $stmt->bindParam(":result", $result);
        $stmt->execute();

    }


    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }
    echo "結果を保存しました！";
}
