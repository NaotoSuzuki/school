<?php
session_start();


// $grammerValue=new Grammer($grammerValue);
$genre_param = $_GET['name'];




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
        $records = $res->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }
    $genres=array_column($records, 'genre','genre_value');
?>



<HTMl>

    <head>
        <meta charset="utf-8">
        <title>Be.you</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <header>
        s
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
