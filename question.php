<?php
session_start();
ini_set(‘display_errors’, 1);
$genre_param = $_GET['name'];



$sql = null;
$res = null;
$dbh = null;




try {
	// DBへ接続
	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

	// SQL作成
	$sql = "SELECT * FROM big_questions;";
	// SQL実行
	$res = $dbh->query($sql);
	$big_records = $res->fetchAll(PDO::FETCH_ASSOC);


	print_r($big_records);
	echo "</br>";
	echo "</br>";


	// SQL作成
	// SQL実行
	$newsql = $dbh->prepare("SELECT big_questions_id, question_num, question FROM small_questions where genre_value = :genre_value order by big_questions_id asc, question_num asc");
	$newsql ->bindparam(':genre_value', $genre_param);
	$newsql ->execute();

	$small_records = $newsql->fetchAll(PDO::FETCH_ASSOC);
	print_r($small_records);


	echo "</br>";
	echo "</br>";
	echo "</br>";

} catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

// $indicates=array();


?>

<HTMl>

	<head>
		<meta charset="UTF-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<?php foreach ($big_records as $big_value):?>
			<?php echo  $big_value[id].$big_value[question] ?>
			<br>
			<br>
				<?php foreach($small_records as $small_value): ?>
					<?php if($big_value[id]==$small_value[big_questions_id]): ?>
						<?php echo  $small_value[question_num].$small_value[question] ?>
						<br>
					<?php endif ?>
				<?php endforeach ?>
				<br>
				<br>

		<?php endforeach ?>



		<?php foreach($big_pares as $bigNum => $bigValue) :?>
			<br>
			<?php echo $bigNum.$bigValue ?>
			<br>
		<?php endforeach ?>



		<form action="answer.php?name=<?php echo $genre_param ?>" method="post">

		<?php $bigQ_flag = 1 ?>
		<!-- フラグと大問idが一致すれば、その大問に属する小問題を全て展開し、小問題を全て展開し終わったら次の配列に進むって感じにする -->




		<?php foreach ($records as $question_arrays): ?>
			<?php if($genre_param == $question_arrays['genre_value']): ?>
				<?php $bigQ_flag = $question_arrays['bigID']?>

				<?php foreach ($big_pares as $bigID => $bigQuestion): ?>
					<?php if($bigQ_flag == $bigID): ?>
						<?php echo "Q".$bigID.".". $bigQuestion ?>

					<?php endif ?>




				<?php foreach($records as $smalls): ?>
					<?php if($bigQ_flag==$smalls['bigID']): ?>
						<br>
						<br>
						<?php echo "(".$smalls['question_num'].")".$smalls['smallQuestion'] ?><br>
						<input type="hidden" name="answer_records[$bigQ_flag][big_questions_id]" value="<?php echo $smalls['bigID'] ?>">
						<input type="hidden" name="answer_records[$bigQ_flag][question_num]" value="<?php echo $smalls['question_num'] ?>">
						<input type="text" name="answer_records[$bigQ_flag][user_answer]"></input>
						<!-- この配列のインデックスを$bigQ_flagと同調させたいんだが。擦ればいい感じでanswerにpostでデータが渡る-->


					<?php  endif ?>

				<?php  endforeach ?>

				<?php $bigQ_flag++ ?>
				<br>
				<br>
				<br>
				<br>
			<?php endforeach ?>
			<?php break ?>
			<?php endif ?>

		<?php endforeach ?>



			 <br>
			 <input type="hidden" name="name" value = "<?php echo $genre_param;?>"/>

			<input type="submit" value="答え合わせをする" />

		</form>
		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
