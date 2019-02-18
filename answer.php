<?php
session_start();
require_once("pdo_class.php");
require_once("answer_controller.php");

$results=$_POST["result"];
$small_answers=$_POST["small_answers"];


$genre_param = $_GET['name'];
// var_dump($_SESSION["ID"]);

$user_id=$_SESSION["ID"];
$records=answerInit($genre_param);
$big_records = $records[0];
$small_records = $records[1];

var_dump($records);


// $sql = null;
// $res = null;
// $dbh = null;
//
//     //答えページの問題と回答を表示させる
// try {
//     // DBへ接続
//     $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
//
//     $sql = "SELECT * FROM big_questions;";
//     $res = $dbh->query($sql);
//     $big_records = $res->fetchAll(PDO::FETCH_ASSOC);
//
//     $sql = "SELECT
//         big_questions.question AS big_question,
//         small_questions.big_questions_id,
//         small_questions.question_num,
//         small_questions.question,
//         answer
//         FROM small_questions
//         inner join big_questions on small_questions.big_questions_id = big_questions.id
//         where  genre_value = :genre_value
//         order by big_questions_id asc, question_num asc";
//
//     $newsql = $dbh->prepare($sql);
//
//     $newsql ->bindparam(':genre_value', $genre_param);
//     $newsql ->execute();
//     $small_records = $newsql->fetchAll(PDO::FETCH_ASSOC);
//
//
    foreach($small_records as $record_value){
        $big_que=$record_value["big_questions_id"];
        $big_q=$record_value["big_question"];
        $small_q=$record_value["question"];
        $small_a=$record_value["answer"];
        $questions1[$big_que]=["big_question"=>$big_q];
        $questions2[$big_que][]="$small_q";
        $answers[$big_que][]="$small_a";
    }

    for($i=1; $i<=3; $i++ ){
        $questions[$i]=$questions1[$i];
        $questions[$i]["questions"]=$questions2[$i];
        $questions[$i]["answers"]=$answers[$i];

    }


// } catch(PDOException $e) {
//     echo $e->getMessage();
//     die();
// }


    //ユーザーの回答を保存する機能
    if (isset($_POST["save"])) {
        var_dump($user_id);


        $results=$_POST["result"];
        $user_answer_array = $_POST["user_answer"];

        foreach ($big_records as $big_value){
            foreach($small_records as $small_value){
                if($big_value["id"]==$small_value["big_questions_id"]){
                    $big_num=$big_value["id"] ;
                        $small_num=$small_value["question_num"];
                        // $small=$small_answers[$big_num][$small_num];
                        $small = $user_answer_array[$big_num][$small_num];
                        $result=$results[$big_num][$small_num];
                        $answer_datas[]=["user_id"=>$user_id, "genre_value"=>$genre_param, "big_questions_id"=>$big_num,"question_num"=>$small_num, "user_answer"=>$small ,"result"=>$result];

                }
            }
        }


        try {
        	// DBへ接続

        	// $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
            $answer_sql = "INSERT INTO users_answer (
                user_id,
                genre_value,
                big_questions_id,
                question_num,
                user_answer,
                result,
                created
            ) VALUES (
                :user_id,
                :genre_value,
                :big_questions_id,
                :question_num,
                :user_answer,
                :result,
                now()
            )";

            foreach ($answer_datas as $answer_data){
                // $stmt = $dbh->prepare();
                $answer_bind_array = null;
                $answer_bind_array = array(
                    "user_id" => $user_id,
                    "genre_value" => $genre_param,
                    "big_questions_id" => $answer_data["big_questions_id"],
                    "question_num" => $answer_data["question_num"],
                    "user_answer" => $answer_data["user_answer"],
                    "result" => $answer_data["result"],
                );
            // $big_ID=$answer_data["big_questions_id"];
                // $question_num=$answer_data["question_num"];
                // $user_answer=$answer_data["user_answer"];
                // $result=$answer_data["result"];
                //
                // // $stmt->bindParam(":user_id", $user_id);
                // $stmt->bindParam(":genre_value", $genre_param);
                // $stmt->bindParam(":big_questions_id", $big_ID);
                // $stmt->bindParam(":question_num", $question_num);
                // $stmt->bindParam(":user_answer", $user_answer);
                // $stmt->bindParam(":result", $result);
                // $stmt->execute();
                $dbh->insertRecord($answer_sql,$answer_bind_array);
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
            <?php var_dump($questions) ?>
        </pre>

        <form action="" name="" method="post">

            <?php foreach($questions as $key => $bigQ_record) :?>
                <div class="answer">
                <?php $count=count($bigQ_record["questions"]) ?>
                <?php $trueCount=$count-1 ?>
                <?php echo $key.".".$bigQ_record["big_question"] ?><br>
                    <?php for($i=0; $i<=$trueCount; $i++) :?>
                        <?php $num=$i+1 ?>
                        <?php $user_answer = $num.$bigQ_record["questions"][$i] ?>
                        <?php $roop_answers[]=["big_questions_id"=>$key, "question_num"=>$num,"user_answer"=> $user_answer]?>
                        <?php echo "(".$num.")".$bigQ_record["questions"][$i] ?><br>
                        <?php echo "答え".$bigQ_record["answers"][$i] ?>
                        <p><?php echo"あなたの答え: ".$small_answers[$key][$num] ?></p>
                        <input type="hidden" name="user_answer[<?php echo $key ?>][<?php echo $num ?>]" value="<?php echo $small_answers[$key][$num] ?>">
                        <input type="checkbox" name="result[<?php echo $key ?>][<?php echo $num ?>]" value="1">正解した！</input><br>
                        <input type="checkbox" name="result[<?php echo $key?>][<?php echo $num ?>]" value="0">間違えた！</input><br>
                    <?php endfor ?>
                <br>
                <br>
                </div>
            <?php endforeach ?>

            <input type="submit" name="save" value="結果を保存する(復習の参考にできます！)" />
			<input type="hidden" name="genre" value = "<?php echo $genre_param;?>"/>
            <input type="hidden" name="small_answers" value="<?php $roop_answers?>"/>

		</form>

		<a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>


	</body>

</HTMl>
