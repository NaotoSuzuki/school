<?php
// エラー表示なし
ini_set('display_errors', 0);
ini_set('display_errors', 1);

$grammerIndicate=array("be動詞"=>"beverb","一般動詞"=>"verb","代名詞"=>"pronoun","三人称"=>"thirdperson","Can"=>"can");
//grammer_classのメソッドを使いたい。
?>

<HTMl>

    <head>
      <meta charset="utf-8">
       <title>Be.you</title>
       <link rel="stylesheet" type="text/css" href="style.css">
   </head>

   <body>
        <p><?php echo $a ?></p>
        <header>
        <h1>Welcome to Be.You</h1>
        </header>

        <div class="container">
          <?php foreach($grammerIndicate as $grammer=>$grammerValue):?>
                <div class="item">
                  <a href="grammer.php?name=<?php echo $grammerValue ?>">
                    <?php echo $grammer?>
                  </a>
                </div>
          <?php endforeach?>
        </div>

      </body>
</HTMl>
