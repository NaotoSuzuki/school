<?php
	session_start();
	require_once("../pdo_class.php");
	require_once("../controller/question_controller.php");
	require_once("../function.php");
	$genre_param = $_GET['name'];

	$records = questionInit($genre_param);
	$small_records = $records[1];
	$questions = formQuestion($small_records);
?>

<HTMl>
	<head>
		<meta charset="UTF-8">
		<title>Be.you</title>
		<link rel = "stylesheet" type = "text/css" href = "../style.css">
	</head>

	<body>
		<form action = "answer.php?name=<?php echo $genre_param ?>" method="post">
			<?php foreach($questions as $key => $bigQ_record) :?>
                <div class="answer">
                <?php $count=count($bigQ_record["questions"]) ?>
                <?php $trueCount=$count-1 ?>
                <?php echo $key.".".$bigQ_record["big_question"] ?><br>
                    <?php for($i = 0; $i <= $trueCount; $i++) :?>
                        <?php $num = $i+1 ?>
                        <?php $user_answer = $num.$bigQ_record["questions"][$i] ?>
                        <?php echo "(".$num.")".$bigQ_record["questions"][$i] ?><br>
						<input type = "text" name = "small_answers[<?php echo $key ?>][<?php echo $num ?>]"></input>
						<br>
					<?php endfor ?>
					<br>
					<br>
                </div>
            <?php endforeach ?>
			<input type = "submit" name="" value = "答え合わせをする" />
		</form>
	<a href = "index.php"><p>トップに戻る</p></a>
</HTMl>
