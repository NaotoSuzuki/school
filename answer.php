<?php
session_start();
require_once("pdo_class.php");
require_once("answer_controller.php");
$small_answers=$_POST["small_answers"];
$genre_param = $_GET['name'];
$user_id=$_SESSION["ID"];
$records=answerInit($genre_param);
$big_records = $records[0];
$small_records = $records[1];

    //DBからのデータを問題表示用の配列に加工
    foreach($small_records as $record_value){
        $big_que=$record_value["big_questions_id"];
        $big_q=$record_value["big_question"];
        $small_q=$record_value["question"];
        $small_a=$record_value["answer"];
        $questions1[$big_que]=["big_question"=>$big_q];
        $questions2[$big_que][]="$small_q";
        $answers[$big_que][]="$small_a";
    }
    //DBからのデータで問題表示用の配列を生成
    for($i=1; $i<=3; $i++ ){
        $questions[$i]=$questions1[$i];
        $questions[$i]["questions"]=$questions2[$i];
        $questions[$i]["answers"]=$answers[$i];
    }



    //ユーザーの回答をDBに保存する機能
    if (isset($_POST["save"])) {
        //ユーザーが回答した正否を$resultsに代入
        $results=$_POST["result"];
        var_dump($results);
        //ユーザーの回答内容を$user_answre_arrayに代入
        $user_answer_array = $_POST["user_answer"];

        //user_asnwersテーブルに挿入するためのデータを配列に加工
        foreach ($big_records as $big_value){
            foreach($small_records as $small_value){
                if($big_value["id"]==$small_value["big_questions_id"]){
                    $big_num=$big_value["id"] ;
                        $small_num=$small_value["question_num"];
                        $small = $user_answer_array[$big_num][$small_num];
                        $result=$results[$big_num][$small_num];
                        //insert文に渡される配列
                        $answer_datas[]=["user_id"=>$user_id, "genre_value"=>$genre_param, "big_questions_id"=>$big_num,"question_num"=>$small_num, "user_answer"=>$small ,"result"=>$result];
                }
            }
        }

        //上記で作成した配列をinsert
        try {
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

            //配列をinsert文にバインド
            foreach ($answer_datas as $answer_data){
                $stmt = $dbh->prepare();
                $param_array= null;
                $param_array = array(
                    "user_id" => $user_id,
                    "genre_value" => $genre_param,
                    "big_questions_id" => $answer_data["big_questions_id"],
                    "question_num" => $answer_data["question_num"],
                    "user_answer" => $answer_data["user_answer"],
                    "result" => $answer_data["result"],
                );
                //sql実行
                $dbh->insertRecord($answer_sql,$param_array);
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
