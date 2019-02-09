<?php
session_start();
$genre_param = $_GET['name'];
ini_set(‘display_errors’, 1);
$answer_records=$_POST;

print_r($answer_records);
echo "<br/>";
echo "<br/>";
var_dump($_POST["result"]);
echo "<br/>";
echo "<br/>";
foreach ($answer_records as $key=>$value) {

    $answer_detect="question_num_".$value;
    if($answer_detect==$key){
        $answer_detect = $value;
    } else{
        $user_answer=$value;
    }

}




$sql = null;
$res = null;
$dbh = null;


try {
	// DBへ接続
	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

	// SQL作成
	$sql = "SELECT genres.genre_value, big_questions.id as bigID, big_questions.question as bigQuestion, small_questions.question_num ,small_questions.question as smallQuestion, small_questions.answer as answer FROM big_questions INNER JOIN small_questions ON big_questions.id = small_questions.big_questions_id INNER JOIN genres ON small_questions.genre_value = genres.genre_value order by bigID asc, question_num asc;";
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


    if(isset($_POST["save"])){

    try {
    	// DBへ接続
    	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');


    	// SQL作成
        $stmt = $pdo->prepare("INSERT INTO users_answer(user_id, genre_value, big_questions_id ,question_num ,user_answer, result, created) VALUES (:user_id, :genre_value, :big_questions_id ,:question_num ,:user_answer, :result ,now() )");
    	// SQL実行


        $user_id=$_SESSION["ID"];
        $genre_value = $genre_param;

        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":genre_value", $genre_value);

        //以下のデータは$_POSTによって配列で渡ってきている
        $stmt->bindParam(":big_questions_id", $bigID);
        $stmt->bindParam(":question_num", $smalls["question_num"]);
        $stmt->bindParam(":user_answer", $user_answer);
        $stmt->execute();


        //update table users_answer result
        // $stmt->bindParam(":result", $result);
        // $stmt->execute();



    } catch(PDOException $e) {
    	echo $e->getMessage();
    	die();
    }

}


?>

<HTMl>

	<head>
		<meta charset="utf-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>

        <form action="" name="save" method="post">

		<?php $bigQ_flag = 1 ?>
		<!-- フラグと大問idが一致すれば、その大問に属する小問題を全て展開し、小問題を全て展開し終わったら次の配列に進むって感じにする -->

		<?php foreach ($records as $question_arrays): ?>

            <br>
            <br>

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
						<?php echo "(".$smalls['question_num'].")".$smalls['smallQuestion']."<br/>"."答え：".$smalls['answer'] ?>
                        <br>

                        <?php $a=0;
                        $user_answers=$_POST["user_answer"];

                        echo "あなたの回答:".$user_answer[$a];
                        $a++;?>



                        <br/>
                        <input type="checkbox" name="result[]" value="0">正解<br/>
                        <input type="checkbox" name="result[]" value="1">不正解<br/>
					<?php  endif ?>


				<?php  endforeach ?>

				<?php $bigQ_flag++ ?>
				<br>
				<br>

			<?php endforeach ?>
			<?php break ?>
			<?php endif ?>

		<?php endforeach ?>



			<input type="submit" value="結果を保存する(復習の参考にできます！)" />
			<input type="hidden" name="name" value = "<?php echo $genre_param;?>"/>

		</form>

		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
