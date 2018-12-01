<?php
require_once("question_class.php");
require_once("pdo_class.php");
$grammerName=$_GET['name'];
$pdo = new mysqlClass();
$records = $pdo->getQuestionRecord($grammerName);
$questionclass = new Question($records);
?>

<HTMl>

  <head>
    <meta charset="utf-8">
   <title>Be.you</title>
   <link rel="stylesheet" type="text/css" href="style.css">
 </head>

  <body>
    <?php  $i=1; foreach ($questionclass->getQuestion() as $question):$j=1;?>
      <div>
        <?php foreach ($question as $key=>$value):?>
                <p><?php
                if ($key == "question"){
                  echo "Q".$i." ".$value ;
                  $i++;
                } else {
                    echo "(".$j.")".$value ;
                  $j++;
                }
                ?></p>
        <?php endforeach ?>
      </div>
    <?php endforeach ?>



  </body>

</HTMl>
