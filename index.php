<?php
require_once("grammer_class.php");
// エラー表示なし
ini_set('display_errors', 0);
ini_set('display_errors', 1);

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
          <?php foreach($grammers as $grammer):?>
            <!--DBから持ってくるか配列を作るか・・・配列を作ろう-->
                <div class="item">
                  <a href="grammer.php?name=<?php echo $grammer->getValue() ?>">
                    <!--grammer_class_phpのリストを参考に連想配列を作り、keyとvalueをそれぞれechoさせる。他に方法あるだろうけど-->
                    <?php echo $grammer->getName() ?>
                  </a>
                </div>
          <?php endforeach?>
        </div>

      </body>
</HTMl>
