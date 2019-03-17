<?php
    session_start();
    $created=$_GET["name"];
    require_once("../controller/study_hist_detail_controller.php");
    require_once("../function.php");
    // $hist_detail_arrays = histInit($user_id);



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
            <?php var_dump($indicate_question) ?>
            <?php var_dump($small_question) ?>
        </pre>



        <!--以下の処理はfunctoinで行って、結果を配列に入れてviewで展開する感じにしたい-->
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
                    <input type="checkbox" name="result[<?php echo $key ?>][<?php echo $num ?>]" value="1">正解した！</input><br>
                    <input type="checkbox" name="result[<?php echo $key?>][<?php echo $num ?>]" value="0">間違えた！</input><br>
                <?php endfor ?>
            <br>
            <br>
            </div>
        <?php endforeach ?>



    </body>

</html>
