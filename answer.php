<?php
session_start();

$genre_param = $_GET['name'];
ini_set(‘display_errors’, 1);
$answer_records=$_POST;

$sql = null;
$res = null;
$dbh = null;


try {
    // DBへ接続
    $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

    $sql = "SELECT * FROM big_questions;";
    $res = $dbh->query($sql);
    $big_records = $res->fetchAll(PDO::FETCH_ASSOC);

    $newsql = $dbh->prepare("SELECT big_questions_id, question_num, question, answer FROM small_questions where genre_value = :genre_value order by big_questions_id asc, question_num asc");

    $newsql ->bindparam(':genre_value', $genre_param);
    $newsql ->execute();
    $small_records = $newsql->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}


print_r($answer);


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


        <?php foreach ($big_records as $big_value):?>
            <?php echo  $big_value[id].$big_value[question] ?>
            <br>
            <br>
                <?php foreach($small_records as $small_value): ?>


                    <?php if($big_value[id]==$small_value[big_questions_id]): ?>
                        <?php echo  $small_value[question_num].$small_value[question] ?>
                        <br>
                        <?php echo "答え:".$small_value[answer]?>
                        <br>
                        <?php $big_num=$big_value[id] ?>
                        <?php $small_num=$small_value[question_num] ?>

                        <?php echo"あなたの答え: ".$answer_records["small_answers"][$big_num][$small_num] ?>

                        <br>
                    <?php endif ?>
                <?php endforeach ?>
                <br>
                <br>
        <?php endforeach ?>




			<input type="submit" value="結果を保存する(復習の参考にできます！)" />
			<input type="hidden" name="genre" value = "<?php echo $genre_param;?>"/>

		</form>

		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
