<?php
require_once("grammer_class.php");
 $grammerName=$_GET['name'];
 $grammer=new Grammer($grammerName);
?>



<HTMl>

  <head>
    <meta charset="utf-8">
   <title>Be.you</title>
   <link rel="stylesheet" type="text/css" href="style.css">
 </head>

  <body>
    <header>
    <h1><?php echo $grammer->getName();?></h1>
  </header>

<div class="detail_container">
  <div class="detail_item">
    <a href="question.php?name=<?php echo $grammer->getValue();?>">問題を解く</a>
  <!--ここにquestion.phpに文法ごとに移れるリンクを貼る。問題もそれぞれ正しく表示されるようにする-->
  </div>
  <div class="detail_item"><p>解説を読む</p></div>
</div>


  </body>

</HTMl>
