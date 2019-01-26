<?php
session_start();
$genre_param = $_GET['name'];


$sql = null;
$res = null;
$dbh = null;


try {
	// DBへ接続
	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

	// SQL作成
	$sql = "SELECT genres.genre_value, big_questions.id as bigID , big_questions.question as bigQuestion, small_questions.question as smallQuestion FROM big_questions INNER JOIN small_questions ON big_questions.id = small_questions.big_questions_id INNER JOIN genres ON small_questions.genre_value = genres.genre_value order by bigID;";
	// SQL実行
	$res = $dbh->query($sql);
	$records = $res->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

$questions=array_column($records, 'smallQuestion','bigQuestion');



?>

<HTMl>

    <head>
        <meta charset="utf-8">
        <title>Be.you</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
		<br>
		<br>
		<br>

		<?php foreach ($records as $question_arrays): ?>
			<?php var_dump($question_arrays); ?>
			<br>
			<br>

				<?php foreach ($question_arrays as $question_array): ?>
					<?php var_dump($question_array); ?>
					<br>
					<br>

				<?php endforeach ?>

		<?php endforeach ?>

        <form action="answer.php" method="post">



                <input type="submit" value="答え合わせをする" />
                <input type="hidden" name="name" value = "<?php echo $genre_param;?>"/>
            </form>
            <a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


        </body>

    </HTMl>
