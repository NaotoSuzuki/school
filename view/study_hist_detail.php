<?php
    session_start();
    $created=$_GET["name"];
    require_once("../controller/study_hist_detail_controller.php");
    require_once("../controller/answer_controller.php");
    require_once("../model/answer_model.php");
    require_once("../function.php");
    // $hist_detail_arrays = histInit($user_id);
    $hist_detail_arrays = InitStudyHistDetail($user_id, $created);


    foreach($hist_detail_arrays as $hist_detail_array){
            $big_que=$hist_detail_array["big_questions_id"];
            $big_q=$hist_detail_array["question_num"];
            $small_a=$hist_detail_array["answer"];
            $small_y=$hist_detail_array["user_answer"];
            $questions1[$big_que]=["big_question"=>$big_q];
            $questions2[$big_que][]="$small_q";
            $answers[$big_que][]="$small_a";
            $user_answer[$big_que][]="$small_y";
        }

    $genre_value = $hist_detail_array["genre_value"];
    $records=answerInit($genre_param);
    $big_records = $records[0];
    $small_records = $records[1];
    $questions = formUser($small_records);

    $hist_indicate = HistInitStudyDetail($user_id, $created, $genre_value);





 ?>


<html>
    <head>
        <meta charset="utf-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
    </head>

    <body>
        <p><?php echo $_SESSION["NAME"]?>さんが<?php echo $created ?>に解いた問題の結果です！</p>

        <pre>
            <?php var_dump($hist_indicate)?>
            <?php var_dump() ?>
        </pre>



        <?php foreach($questions as $key => $bigQ_record) :?>

            <div class="answer">
            <?php $count=count($bigQ_record["questions"]) ?>
            <?php $trueCount=$count-1 ?>
            <?php echo $key.".".$bigQ_record["big_question"] ?><br>
                <?php for($i=0; $i<=$trueCount; $i++) :?>
                    <?php $num=$i+1 ?>
                    <?php $user_answer = $num.$bigQ_record["questions"][$i] ?>
                    <?php $roop_answers[]=["big_questions_id"=>$key, "question_num"=>$num,"user_answer"=> $user_answer]?>
                    <?php echo "(".$num.")".$bigQ_record["questions"][$i] ?><br>
                    <?php echo "答え".$bigQ_record["answers"][$i] ?>
                    <p><?php echo"あなたの答え: ".$small_answers[$key][$num] ?></p>
                    <input type="hidden" name="user_answer[<?php echo $key ?>][<?php echo $num ?>]" value="<?php echo $small_answers[$key][$num] ?>">

                <?php endfor ?>
            <br>
            <br>
            </div>
        <?php endforeach ?>



    </body>

</html>
