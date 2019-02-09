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

		$sql = "SELECT * FROM big_questions;";
		$res = $dbh->query($sql);
		$big_records = $res->fetchAll(PDO::FETCH_ASSOC);

		$newsql = $dbh->prepare("SELECT big_questions_id, question_num, question FROM small_questions where genre_value = :genre_value order by big_questions_id asc, question_num asc");

		$newsql ->bindparam(':genre_value', $genre_param);
		$newsql ->execute();
		$small_records = $newsql->fetchAll(PDO::FETCH_ASSOC);

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
			<p>この問題を解くために必要な知識</p>
			<ul>
				<li>文型</li>
				<li>疑問系</li>
			</ul>
			<?php foreach ($big_records as $big_value):?>
				<?php echo  $big_value[id].$big_value[question] ?>
				<br>
				<br>
					<?php foreach($small_records as $small_value): ?>
						<?php print_r($small_value) ?>
						<br>
						<?php if($big_value[id]==$small_value[big_questions_id]): ?>
							<?php echo  $small_value[question_num].$small_value[question] ?>
							<?php $big_num=$big_value[id] ?>
							<?php $question_num=$small_value[question_num] ?>
							<br>
							<input type="text" name="small_answers[<?php echo $big_num ?>][<?php echo $question_num ?>]"></input>
							<br>

						<?php endif ?>
					<?php endforeach ?>
					<br>
					<br>
			<?php endforeach ?>

			<input type="hidden" name="name" value = "<?php echo $genre_param;?>"/>
			<input type="submit" value="答え合わせをする" />

		</form>
		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
