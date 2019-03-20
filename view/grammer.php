<?php
    session_start();
    require_once("../controller/grammer_controller.php");
    $genre_param = $_GET['name'];
    $genres = getGrammerIndicate();
?>

<HTMl>
    <head>
        <meta charset="utf-8">
        <title>Be.you</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <header>
        </header>
        <?php foreach ($genres as $key => $value): ?>
            <?php if($key == $genre_param): ?>
                <div class="detail_container">
                    <div class="detail_item">
                        <a href="question.php?name=<?php echo $genre_param;?>">問題を解く</a>
                    </div>
                    <div class="detail_item">
                        <a href="explain.php?name=<?php echo $genre_param;?>">解説を読む</a>
                    </div>
                </div>
                <?php break; ?>>
            <?php endif ?>
        <?php endforeach ?>
        <div class="navigater"><a href="index.php">文法一覧に戻る</a></div>
    </body>
</HTMl>
