<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_errors', 1);

 // $grammerValue=new Grammer($grammerValue);

 $sql = null;
 $res = null;
 $dbh = null;

 try {
 	// DBへ接続
 	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');

 	// SQL作成
 	$sql = "SELECT genres.id , genres.genre, genres.genre_value FROM  genres order by id";
 	// SQL実行

 	$res = $dbh->query($sql);

 } catch(PDOException $e) {
 	echo $e->getMessage();
 	die();
 }

 
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
