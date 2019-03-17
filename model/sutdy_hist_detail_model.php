<?php
    require_once("../function.php");
    require_once("../controller/study_hist_detail_controller.php");


    //以下のメソッドの流用はどんくさいのでクラスにしておく
    function getSmallQuestion($genre_value){

        try {
            $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT
                small_questions.big_questions_id,
                small_questions.question_num,
                small_questions.question,
                small_questions.answer,
                big_questions.question as big_question
                FROM small_questions
                inner join big_questions
                on small_questions.big_questions_id = big_questions.id
                where genre_value = :genre_value
                order by big_questions_id asc,
                question_num asc";
            $stmt=$dbh->prepare($sql);
            $stmt->bindParam(":genre_value",$genre_value);
            $stmt->execute();
            $small_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $small_records;
        }


        function getBigQuestion(){
            $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            try {

                $sql = "SELECT * FROM big_questions order by id asc";
                $stmt = $dbh->query($sql);
                $big_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($small_records);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                return $big_records;
            }



    function getStudyHistDetail($user_id, $created){
        $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try{
            $sql="SELECT
                users_answer.big_questions_id,
                users_answer.user_answer,
                users_answer.result,
                users_answer.genre_value
                from users_answer
                where  users_answer.user_id = :user_id
                and users_answer.created = :created
                order by big_questions_id asc, question_num asc";
                $stmt=$dbh->prepare($sql);
                $stmt->bindParam(":user_id",$user_id);
                $stmt->bindParam(":created",$created);
                $stmt->execute();
                $hist_detail_arrays = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e) {
               echo $e->getMessage();
               die();
           }
           return $hist_detail_arrays;
    }




    // function getQuestionCode($genre_param){
    //     $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
    //     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     try{
    //
    //         $sql="SELECT
    //             users_answer.genre_value,
    //             users_answer.big_questions_id,
    //             users_answer.question_num,
    //             users_answer.user_answer,
    //             users_answer.result,
    //             users_answer.created
    //             from users_answer
    //             where  users_answer.user_id = :user_id
    //             and users_answer.created = :created
    //             order by big_questions_id asc, question_num asc";
    //
    //             $stmt=$dbh->prepare($sql);
    //             $stmt->bindParam(":user_id",$user_id);
    //             $stmt->bindParam(":created",$created);
    //             $stmt->execute();
    //             $hist_detail_arrays = $stmt->fetchAll();
    //         }
    //         catch(PDOException $e) {
    //            echo $e->getMessage();
    //            die();
    //        }
    //        return $hist_detail_arrays;
    // }


    function HistGetStudyDetail($user_id, $created, $genre_value){
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
            	small_questions.question as small_question,
                small_questions.answer,
                big_questions.question as big_question
                -- big_questions.question
                from users_answer
                inner join small_questions on users_answer.genre_value = small_questions.genre_value
                and users_answer.big_questions_id = small_questions.big_questions_id
                and users_answer.question_num = small_questions.question_num
                and users_answer.genre_value = :genre_value
                inner join big_questions on users_answer.big_questions_id = big_questions.id
                where  users_answer.user_id = :user_id
                and users_answer.created = :created
                and users_answer.genre_value = :genre_value
                and small_questions.genre_value = :genre_value
                order by big_questions_id asc, question_num asc";

                $stmt=$dbh->prepare($sql);
                $stmt->bindParam(":user_id",$user_id);
                $stmt->bindParam(":created",$created);
                $stmt->bindParam(":genre_value",$genre_value);
                $stmt->execute();
                $hist_detail_arrays = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e) {
               echo $e->getMessage();
               die();
           }
           return $hist_detail_arrays;
    }
