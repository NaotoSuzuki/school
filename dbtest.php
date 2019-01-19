<?php
require_once("pdo_class.php");

// sql実行時の例外処理のためにtry catchで囲む
try {
// PDOオブジェクトの生成
    $pdo = new PDO(
       'mysql:host=localhost;dbname=test;charset=utf8mb4',
       'test',
       'test');


      //エラー時の動作を指定
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        // methodがPOSTだったら
        // $postに入れる
        $post = $_POST;
        // 変数ありのSqlの準備
        $stmt = $pdo->prepare("INSERT INTO test_table(name, age, address) VALUES (:name, :age, :address)");
        // Sqlに値を入れる(bind)
        $stmt->bindParam(':name', $post['name'], PDO::PARAM_STR);
        $stmt->bindParam(':age', $post['age'], PDO::PARAM_INT);
        $stmt->bindParam(':address', $post['address'], PDO::PARAM_STR);
        // Sqlの実行
        $stmt->execute();
        echo "登録完了</br>";
        var_dump($post);
    } else if ($_SERVER['REQUEST_METHOD'] == "GET"){
        // methodがPOST以外だったら
        // カラム名
        echo "name, age, address</br>";
        // 変数なしSqlの準備
        $stmt = $pdo->query("SELECT * from test_table");
        // 全レコードを配列で取ってくる
        // 用途によってモード変えてもいい http://php.net/manual/ja/pdostatement.fetch.php
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // 取得したレコードをforeachで展開
        // レコード単位で回す
        foreach ($records as $record) {
            // カラム単位で回す
            foreach ($record as $key => $value) {
                //カラムの処理分岐
                if ($key != "address"){
                    echo $value.", ";
                } else {
                    echo $value;
                }
            }
            //レコードごとに改行
            echo "</br>";
        }
    } else {
        // putとかdeleteとかできたら
        echo "http methodは GETかPOSTを指定してください。";
    }
} catch (PDOException $e){
    //エラーメッセージ表示
    echo $e->getMessage()." - ".$e->getLine().PHP_EOL;

}


?>
