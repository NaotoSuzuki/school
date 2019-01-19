<?php
// エラー表示なし
ini_set('display_errors', 1);

session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

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

        <header>
        <h1>"ユーザーさん"　Welcome to Be.You</h1>
        </header>

        <div class="options">
            <p>学習の進捗を確認する</p>
            <p>成績を確認する</p><!-- 回答した問題の一覧を表示する studied_questions.php-->

        </div>

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
