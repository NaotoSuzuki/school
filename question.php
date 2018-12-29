<?php
require_once("question_class.php");
require_once("pdo_class.php");
$grammerName=$_GET['name'];
$pdo = new mysqlClass();
$records = $pdo->getQuestionRecord($grammerName);
//各文法の大問題と少問題がDBより取得されたものを$recordsに代入
$questionclass = new Question($records);
//DBから取得されたデータに対してQuestionクラスのメソッドを使えるようにする

$postflg=false;
if (isset($_POST["hoge"])){

    $postflg=true;
}
?>

<HTMl>

    <head>
        <meta charset="utf-8">
        <title>Be.you</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <form action="answer.php" method="post">
            <?php  $i=0; foreach ($questionclass->getQuestion() as $question):$j=0;?>
                <!--getQuestionメソッドによってDBの大問、小問のデータを取得し、$questionに格納  -->
                <?php  var_dump($questionclass);?>
                <br>
                <br>
                <?php  var_dump($question);?>
                <div>
                    <?php foreach ($question as $key=>$value):?>
                        <!--$questionの$keyが"question"なら大問を、そうでないなら小問"sentense"を表示 -->
                        <!--answer.phpの配列がうまく表示できないのは、if分の変数名とと配列の"$key"と"$value"の値が一致していないからではないか  -->
                        <p><?php
                        if ($key == "question"){
                            $i++;
                            echo "Q".$i." ".$value ;
                        } else {
                            $j++;
                            echo "(".$j.")".$value ;
                            echo "</br>";
                            if ($postflg){
                                echo '<p>', $_POST[strval($i).strval($j)] ,'</p>';

                            } else {
                                echo '<input name="',strval($i),strval($j),'"></input>';
                            }
                        }
                        ?></p>


                    <?php endforeach ?>
                </div>
            <?php endforeach ?>

                <input type="submit" value="答え合わせをする" />
                <input type="hidden" name="name" value = "<?php echo $grammerName;?>"/>
            </form>
            <a href="explain.php?name=<?php echo $grammerName;?>">解説を読む</a>


        </body>

    </HTMl>
