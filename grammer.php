<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_errors', 1);
require_once("grammer_class.php");
 $grammerName=$_GET['name'];
 $grammer=new Grammer($grammerName);
 // $grammerValue=new Grammer($grammerValue);
?>



<HTMl>

  <head>
    <meta charset="utf-8">
   <title>Be.you</title>
   <link rel="stylesheet" type="text/css" href="style.css">
 </head>

  <body>
    <header>
        <?php echo $_SESSION["NAME"]?>
    <h1><?php echo $grammer->getName();?></h1>
  </header>

<div class="detail_container">
  <div class="detail_item">
    <a href="question.php?name=<?php echo $grammer->getValue();?>">問題を解く</a>
  </div>
  <div class="detail_item">
    <a href="explain.php?name=<?php echo $grammer->getValue();?>">解説を読む</a>
  </div>
</div>
  <div class="navigater"><a href="index.php">文法一覧に戻る</a></div>

  </body>

</HTMl>
