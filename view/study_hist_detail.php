<?php
    session_start();
    $created=$_GET["name"];
    require_once("../controller/study_hist_detail_controller.php");
    require_once("../function.php");
    $hist_detail_arrays = InitStudyHistDetail($user_id, $created);
    $genre_value = hist_genre($hist_detail_arrays);
    $questions = formUser($small_records);
    $hist_indicate_datas = HistInitStudyDetail($user_id, $created, $genre_value);
    $hist_indicates = HistIndicateDataInit($hist_indicate_datas)


 ?>


<html>
    <head>
        <meta charset="utf-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
    </head>

    <body>
        <p><?php echo $_SESSION["NAME"]?>さんが<?php echo $created ?>に解いた問題の結果です！</p>
        <?php foreach($hist_indicates as $key => $hist_indicate) :?>
            <div class="answer">
            <?php $count=count($hist_indicates) ?>
            <?php $trueCount=$count-1 ?>
            <?php echo $key.".".$hist_indicate["big_question"] ?><br>
                <?php for($i=0; $i<=$trueCount; $i++) :?>
                    <?php $num=$i+1 ?>
                    <?php echo "(".$num.")".$hist_indicate["questions"][$i] ?><br>
                    <?php echo "答え".$hist_indicate["answers"][$i] ?>
                    <?php if($hist_indicate["user_answers"][$i] != ""):?>
                        <p><?php echo"あなたの答え: ".$hist_indicate["user_answers"][$i] ?></p>
                    <?php else :?>
                        <p>回答が未入力でした</p>
                    <?php endif ?>
                    <?php if($hist_indicate["user_result"][$i] == "1"):?>
                        <p>正解</p>
                    <?php elseif($hist_indicate["user_result"][$i] == "0") :?>
                        <p>間違い</p>
                    <?php else :?>
                        <p>結果が未入力でした</p>

                    <?php endif ?>

                <?php endfor ?>
            <br>
            <br>
            </div>
        <?php endforeach ?>



    </body>

</html>
