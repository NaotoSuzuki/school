<?php
session_start();
ini_set(‘display_errors’, 1);
echo $_SESSION['ID'];
$genre_param = $_GET['name'];


$sql = null;
$res = null;
$dbh = null;




try {
	// DBへ接続
	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

	// SQL作成
	$sql = "SELECT genres.genre_value, big_questions.id as bigID , big_questions.question as bigQuestion, small_questions.question_num ,small_questions.question as smallQuestion FROM big_questions INNER JOIN small_questions ON big_questions.id = small_questions.big_questions_id INNER JOIN genres ON small_questions.genre_value = genres.genre_value order by bigID asc, question_num asc;";
	// SQL実行
	$res = $dbh->query($sql);
	$records = $res->fetchAll(PDO::FETCH_ASSOC);

	$big_pares =array_column($records, "bigQuestion","bigID");



	$small_pares = array_column($records,"smallQuestion");
	// var_dump($small_pares);


} catch(PDOException $e) {
	echo $e->getMessage();
	die();
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
						<input type="text" name="user_answer.<?php echo $smalls['bigID'].$smalls['question_num'] ?>"></input>


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
