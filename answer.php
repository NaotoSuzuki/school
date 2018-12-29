<?php
ini_set('display_errors', 0);
ini_set('display_errors', 1);
//require_once("question_class.php");
require_once("answer_class.php");
require_once("pdo_class.php");
$grammerName=$_POST['name'];
$pdo = new mysqlClass();

$records = $pdo->getAnswerRecord($grammerName);
$answerclass = new Answer($records);


?>

<!--問題と答えをPDOで持ってきて、回答内容をquestion.phpから持ってくる -->

<HTMl>

    <head>
        <meta charset="utf-8">
        <title>Be.you</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form action="" method="post">
            <?php  $i=0; foreach ($answerclass->getAnswer() as $answer):$j=1;?>
                <div>
                    <!-- <?php var_dump($answer) ?> -->
                    <?php foreach ($answer as $key=>$answerValue):?>
                        <p><?php
                        if ($key == "question"){
                            $i++;
                            echo "Q".$i." ".$answerValue ;
                        } else {
                            $sentence = "sentence_" . $j;
                            // var_dump($key);
                            if ($key == $sentence){
                                echo "(".$j.")".$answerValue ;
                                // echo "</br>";
                                // var_dump("sentence");
                            } else {
                                echo $answerValue ;
                                echo "</br>";
                                echo '<p>', $_POST[strval($i).strval($j)] ,'</p>';
                                $j++;
                                // var_dump("answer");
                            }

                                // このコードをanswerDBに対応させる
                        }
                            ?></p>
                            <?//php endforeach ?>
                        <?php endforeach ?>
                    </div>
                    <?//php endforeach ?>
                <?php endforeach ?>
                <input type="hidden" name="name" value = "<?php echo $grammerName;?>"></input>
            </form>
            <a href="explain.php?name=<?php echo $grammerName;?>">解説を読む</a>


        </body>

    </HTMl>
