<?php
session_start();
$results=$_POST["result"];
$small_answers=$_POST["small_answers"];


$genre_param = $_GET['name'];

$user_id=$_SESSION["ID"];

print_r($_POST);

ini_set(‘display_errors’);
echo "<br>";
echo "<br>";




$sql = null;
$res = null;
$dbh = null;


try {
    // DBへ接続
    $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

    $sql = "SELECT * FROM big_questions;";
    $res = $dbh->query($sql);
    $big_records = $res->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT
        big_questions.question AS big_question,
        small_questions.big_questions_id,
        small_questions.question_num,
        small_questions.question,
        answer
        FROM small_questions
        inner join big_questions on small_questions.big_questions_id = big_questions.id
        where  genre_value = :genre_value
        order by big_questions_id asc, question_num asc";

    $newsql = $dbh->prepare($sql);

    $newsql ->bindparam(':genre_value', $genre_param);
    $newsql ->execute();
    $small_records = $newsql->fetchAll(PDO::FETCH_ASSOC);


    foreach($small_records as $record_value){
            $big_que=$record_value["big_questions_id"];
            $big_q=$record_value["big_question"];
            $small_q=$record_value["question"];
            $small_a=$record_value["answer"];
            $questions1[$big_que]=["big_question"=>$big_q];
            $questions2[$big_que][]="$small_q";
            $answers[$big_que][]="$small_a";
    }

    //大問と小問と答えの配列を作っている各foreachは一つにまとめておく


    for($i=1; $i<=3; $i++ ){

        $questions[$i]=$questions1[$i];
        $questions[$i]["questions"]=$questions2[$i];
        $questions[$i]["answers"]=$answers[$i];

        echo "<br>";
        echo "<br>";
    }



    //
    // $question[0] = array("question" => "もんだいぶん1", "small_question" =>array("question1","question2","question3"));
    // $question[1] = array("question" => "もんだいぶん2", "small_question" =>array("question1","question2","question3"));
    // var_dump($question);

} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}



    if (isset($_POST["save"])) {

        echo "<br>";
        echo "<br>";
        print_r($_POST);
        echo "<br>";
        echo "<br>";

        $results=$_POST["result"];
        $user_answer_array = $_POST["user_answer"];

        foreach ($big_records as $big_value){
            foreach($small_records as $small_value){
                if($big_value[id]==$small_value[big_questions_id]){
                    print_r($small_value);


                        $big_num=$big_value[id] ;
                        $small_num=$small_value[question_num];
                        // $small=$small_answers[$big_num][$small_num];
                        $small = $user_answer_array[$big_num][$small_num];
                        $result=$results[$big_num][$small_num];
                        $answer_datas[]=["user_id"=>$user_id, "genre_value"=>$genre_param, "big_questions_id"=>$big_num,"question_num"=>$small_num, "user_answer"=>$small ,"result"=>$result];

                        print_r($big_datas);
                        echo "<br>";
                        echo "<br>";
                }
            }
        }
    try {
    	// DBへ接続

    	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

        foreach ($answer_datas as $answer_data){

            $stmt = $dbh->prepare("INSERT INTO users_answer (user_id, genre_value, big_questions_id ,question_num ,user_answer ,result ,created) VALUES (:user_id, :genre_value, :big_questions_id ,:question_num ,:user_answer, :result ,now() )");

            $big_ID=$answer_data["big_questions_id"];
            $question_num=$answer_data["question_num"];
            $user_answer=$answer_data["user_answer"];
            $result=$answer_data["result"];

            // $user_id=$_SESSION["ID"];
            // $genre_value = $genre_param;

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":genre_value", $genre_param);
            $stmt->bindParam(":big_questions_id", $big_ID);
            $stmt->bindParam(":question_num", $question_num);
            $stmt->bindParam(":user_answer", $user_answer);
            $stmt->bindParam(":result", $result);
            $stmt->execute();

        }


        } catch(PDOException $e) {
        	echo $e->getMessage();
        	die();
        }
        echo "結果を保存しました！";
}




?>

<HTMl>

	<head>
		<meta charset="utf-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
<pre>
    <?php var_dump($small_records); ?>
    <br>
    <br>
    <?php var_dump($questions1); ?>
    <br>
    <br>
    <?php var_dump($questions2); ?>
    <br>
    <br>
    <?php var_dump($answers);?>

    <br>
    <br>
    <?php var_dump($record_value); ?>
    <br>
    <br>
    <?php var_dump($questions); ?>
    <br>
    <br>






</pre>
        <form action="" name="" method="post">



        <?php foreach ($big_records as $big_value):?>
            <div class="answer">
                <p><?php echo  $big_value[id].$big_value[question] ?></p>
                <?php foreach($small_records as $small_value): ?>
                    <?php var_dump($small_value); ?>
                    <br>
                    <br>
                    <div>
                    <?php if($big_value[id]==$small_value[big_questions_id]): ?>
                        <?php $big_num=$big_value[id] ?>
                        <?php $small_num=$small_value[question_num] ?>
                        <?php $small_answer= $small_answers[$big_num][$small_num]?>
                        <?php $roop_answers[]=["big_questions_id"=>$big_num, "question_num"=>$small_num,"user_answer"=>$small_answer] ?>
                        <p ><?php echo  $small_value[question_num].$small_value[question] ?></p>
                        <p><?php echo "答え:".$small_value[answer]?></p>
                        <p ><?php echo"あなたの答え: ".$small_answers[$big_num][$small_num] ?></p>
                        <input type="hidden" name="user_answer[<?php echo $big_num ?>][<?php echo $small_num ?>]" value="<?php echo $small_answers[$big_num][$small_num] ?>">
                        <input type="checkbox" name="result[<?php echo $big_num ?>][<?php echo $small_num ?>]" value="1">正解した！</input><br>
                        <input type="checkbox" name="result[<?php echo $big_num?>][<?php echo $small_num ?>]" value="0">間違えた！</input>
                    <?php endif ?>
                </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>




			<input type="submit" name="save" value="結果を保存する(復習の参考にできます！)" />
			<input type="hidden" name="genre" value = "<?php echo $genre_param;?>"/>
            <input type="hidden" name="small_answers" value="<?php $roop_answers?>"/>

		</form>

		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
