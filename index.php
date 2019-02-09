<?php
session_start();
// エラー表示なし
ini_set('display_errors', 1);
// require_once("pdo_class.php");

// $pdo=new mysqlClass();

// var_dump($_SESSION);
// var_dump($_SESSION["NAME"]);
//
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

// $grammerIndicate=$pdo->setGenreName();
// var_dump($grammerIndicate);

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
        <h1><?php echo $_SESSION["NAME"]?>さん、Welcome to Be.You！</h1>
        </header>

        <div class="options">
            <p>学習の進捗を確認する</p>
            <p>成績を確認する</p><!-- 回答した問題の一覧を表示する studied_questions.php-->
            <a href="Logout.php">ログアウト</a>

        </div>

        <div class="container">

			<?php foreach($res as $values):?>
				<?php $genre=[];?>
                <!-- ↑必要ない -->
				<br>
				<br>

				<div class="item">
				  <a href="grammer.php?name=<?php  echo $genre=$values['genre_value']; ?>">
					<?php  echo $genre=$values['genre']; ?>
				  </a>
				</div>
			<?php endforeach?>


        </div>

      </body>
</HTMl>
