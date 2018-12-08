<?php
// エラー表示なし
ini_set('display_errors', 0);
ini_set('display_errors', 1);



// $beverbValue=new Index('beverb');
// $verbValue=new Index('verb');
// $pronounValue=new Index('pronoun');
// $thirdPersonValue=new Index('thirdperson');
// $canValue=new Index('can');
  $grammerIndicate=array("be動詞"=>"beverb","一般動詞"=>"verb");
?>

<HTMl>

    <head>
      <meta charset="utf-8">
       <title>Be.you</title>
       <link rel="stylesheet" type="text/css" href="style.css">
   </head>

   <body>

        <header>
        <h1>Welcome to Be.You</h1>
        </header>

        <div class="container">
          <?php

          foreach($grammerIndicate as $grammer=>$grammerValue):?>
                <div class="item">
                  <a href="grammer.php?name=<?php echo $grammerValue ?>">
                    <p><?php echo $grammer ?></p>
                  </a>
                </div>
              <?php endforeach?>
        </div>

      </body>
</HTMl>
