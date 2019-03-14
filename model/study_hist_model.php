<?php
    require_once("../pdo_class.php");
    require_once("../function.php");
    require_once("../controller/study_hist_controller.php");



    function getStudyHist($user_id){
        $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try{

            $sql="SELECT
                users_answer.genre_value,
                users_answer.big_questions_id,
                users_answer.question_num,
                users_answer.user_answer,
                users_answer.result,
                users_answer.created,
                genres.genre,
                small_questions.answer,
                big_questions.question
                from users_answer
                join genres on users_answer.genre_value = genres.genre_value
                join small_questions on users_answer.genre_value = small_questions.genre_value
                join big_questions on users_answer.big_questions_id = big_questions.id
                where users_answer.user_id = :user_id
                order by created desc";

                $stmt=$dbh->prepare($sql);
                $stmt->bindParam(":user_id",$user_id);
                $stmt->execute();
                $hist_array = $stmt->fetchAll();
            }
            catch(PDOException $e) {
               echo $e->getMessage();
               die();
           }
           return $hist_array;
    }
