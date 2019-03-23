<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

    <?php
    $pagelog = "pages.dat";		// 作成したページ一覧を保存するファイル
    if ($_POST{"text"}) {
        // POSTデータを全て受け取りエスケープして変数に入れる
        foreach($_POST as $k => $v) {
            if(get_magic_quotes_gpc()) { $v=stripslashes($v); }
            // $v=htmlspecialchars($v);
            $array[$k]=$v;
        }
        extract($array);

        // 文字コードをEUCに変換
        $text = mb_convert_encoding($text, "UTF-8","AUTO");
        $pagetitle = mb_convert_encoding( htmlspecialchars($pagetitle), "UTF-8","AUTO");

        // 改行を<br>タグに変換
        $text = nl2br($text);

        try{
            echo "a";
            $pdo = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
            $sql = "INSERT INTO explain_pages(
                title,
                content,
                genre
            )VALUES(
                :title,
                :content,
                :genre
            )";
            $stmt = $pdo->prepare($sql);
            $title = $pagetitle;
            $content = $text;
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":content", $content);
            $stmt->bindParam(":genre", $genre);
            $stmt->execute();
        }catch(PDOException $e) {
           echo $e->getMessage();
           die();
       }

} else {
    echo "フォームから記事の内容を送信してください。";
}

var_dump($_POST);
?>

</body>
</html>
