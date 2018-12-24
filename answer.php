<?php
ini_set('display_errors', 0);
ini_set('display_errors', 1);
require_once("question_class.php");
require_once("pdo_class.php");
$grammerName=$_GET['name'];
$pdo = new mysqlClass();
$records = $pdo->getQuestionRecord($grammerName);
$questionclass = new Question($records);
$postflg=false;
if (isset($_POST["hoge"])){

  $postflg=true;
}
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
      <input type="hidden" name="hoge" value = "post"></input>
    </form>
    <a href="explain.php?name=<?php echo $grammerName;?>">解説を読む</a>


  </body>

</HTMl>
