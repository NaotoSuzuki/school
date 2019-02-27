<?php
	session_start();
	require_once("pdo_class.php");
	require_once("question_controller.php");

	$genre_param = $_GET['name'];



	$records=questionInit($genre_param);
	$big_records = $records[0];
	$small_records = $records[1];

	foreach($small_records as $record_value){
		$big_que=$record_value["big_questions_id"];
		$big_q=$record_value["big_question"];
		$small_q=$record_value["question"];
		$questions1[$big_que]=["big_question"=>$big_q];
		$questions2[$big_que][]="$small_q";
	}

	for($i=1; $i<=3; $i++ ){
		$questions[$i]=$questions1[$i];
		$questions[$i]["questions"]=$questions2[$i];
	}
?>

<HTMl>
	<head>
		<meta charset="UTF-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>

		<form action="answer.php?name=<?php echo $genre_param ?>" method="post">
			<p>この問題を解くために必要な知識</p>
			<ul>
				<li>文型</li>
				<li>疑問系</li>
			</ul>

			<?php foreach($questions as $key => $bigQ_record) :?>
                <div class="answer">
                <?php $count=count($bigQ_record["questions"]) ?>
                <?php $trueCount=$count-1 ?>
                <?php echo $key.".".$bigQ_record["big_question"] ?><br>
                    <?php for($i=0; $i<=$trueCount; $i++) :?>
                        <?php $num=$i+1 ?>
                        <?php $user_answer = $num.$bigQ_record["questions"][$i] ?>
                        <?php echo "(".$num.")".$bigQ_record["questions"][$i] ?><br>
						<input type="text" name="small_answers[<?php echo $key ?>][<?php echo $num ?>]"></input>
						<br>
					<?php endfor ?>
					<br>
					<br>
                </div>
            <?php endforeach ?>
			<input type="submit" name="" value="答え合わせをする" />

		</form>
		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
