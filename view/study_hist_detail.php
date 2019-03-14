<?php
    session_start();
    $created=$_GET["name"];
    require_once("../controller/study_hist_detail_controller.php");
    require_once("../function.php");
    // $hist_detail_arrays = histInit($user_id);
    $hist_detail_arrays = InitStudyHistDetail($user_id, $created);


    // questionsテーブルからanswerも
    foreach($hist_detail_arrays as $hist_detail_array){
            $big_que=$hist_detail_array["big_questions_id"];
            $big_q=$hist_detail_array["question_nums"];
            $small_a=$hist_detail_array["answer"];
            $small_y=$hist_detail_array["user_answer"];
            $questions1[$big_que]=["big_question"=>$big_q];
            $questions2[$big_que][]="$small_q";
            $answers[$big_que][]="$small_a";
            $user_answer[$big_que][]="$small_y";

            for($i=1; $i<=3; $i++ ){
                $questions[$i]=$questions1[$i];
                $questions[$i]["questions"]=$questions2[$i];
                $questions[$i]["answers"]=$answers[$i];
                $questions[$i]["user_answer"]=$answers[$i];
            }

    }

    $genre_value = $hist_detail_array["genre_value"];


    $big_questions = BigQuestionInit();
    $small_questions = SmallQuestionInit($genre_value);
    var_dump($big_questions);




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
            <?php var_dump($hist_detail_arrays) ?>
        </pre>



        <!--以下の処理はfunctoinで行って、結果を配列に入れてviewで展開する感じにしたい-->
        <?php $time=0 ?>
        <?php foreach($hist_detail_arrays as $hist_detail_array): ?>
            <?php if($created == $hist_detail_array["created"]) :?>

                <pre>

                </pre>


            <?php endif ?>
        <?php endforeach?>


    </body>

</html>
