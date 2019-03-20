<?php
    session_start();
    require("../controller/answer_controller.php");
    require("../function.php");
    $user_id = $_SESSION["ID"];
    $genre_param  =  $_GET['name'];
    //ユーザーがquestion.phpで入力した回答内容
    $small_answers = $_POST["small_answers"];

    /*問題表示用のデータ取得
    *$big_records:回答保存時に大問番号なども保存するため
    *$small_records　: 問題表示と回答データ保存用
    */
    $records = answerInit($genre_param);
    $big_records  =  $records[0];
    $small_records  =  $records[1];
    
    //ユーザーの回答と少問題のデータを表示用の配列に生成
    $questions  =  formUserAnswerAndQuestion($small_records);

    //「保存する」ボタンが押されたらユーザーの回答をusers_answerテーブルに保存する
    if (isset($_POST["save"])) {
        $results = $_POST["result"];
        $user_answer_array  =  $_POST["user_answer"];
        $answer_datas  =  formUserAnswer($user_id, $genre_param, $results, $user_answer_array, $big_records, $small_records);
        putUserAnwser($answer_datas);
        echo "結果を保存しました！";
    }

?>

<HTMl>
    <head>
		<meta charset = "utf-8">
		<title>Be.you</title>
		<link rel = "stylesheet" type = "text/css" href = "../style.css">
	</head>
    <body>
        <form action = "" name = "" method = "post">
            <?php foreach($questions as $key  => $bigQ_record) :?>
                <div class = "answer">
                    <?php $count  =  count($bigQ_record["questions"]) ?>
                    <?php $trueCount = $count-1 ?>
                    <?php echo $key.".".$bigQ_record["big_question"] ?><br>
                        <?php for($i  =  0; $i<= $trueCount; $i++) :?>
                            <?php $num = $i+1 ?>
                            <?php $user_answer  =  $num.$bigQ_record["questions"][$i] ?>
                            <?php $roop_answers[] = ["big_questions_id" => $key, "question_num" => $num,"user_answer" => $user_answer]?>
                            <?php echo "(".$num.")".$bigQ_record["questions"][$i] ?><br>
                            <?php echo "答え".$bigQ_record["answers"][$i] ?>
                            <p><?php echo"あなたの答え: ".$small_answers[$key][$num] ?></p>
                            <input type = "hidden" name = "user_answer[<?php echo $key ?>][<?php echo $num ?>]" value = "<?php echo $small_answers[$key][$num] ?>">
                            <input type = "checkbox" name = "result[<?php echo $key ?>][<?php echo $num ?>]" value = "1">正解した！</input><br>
                            <input type = "checkbox" name = "result[<?php echo $key?>][<?php echo $num ?>]" value = "0">間違えた！</input><br>
                        <?php endfor ?>
                    <br>
                    <br>
                </div>
            <?php endforeach ?>

            <input type = "submit" name = "save" value = "結果を保存する(復習の参考にできます！)" />
			<input type = "hidden" name = "genre" value  =  "<?php echo $genre_param;?>"/>
            <input type = "hidden" name = "small_answers" value = "<?php $roop_answers?>"/>

		</form>

		<a href = "index.php"><p>トップに戻る</p></a>


	</body>

</HTMl>
