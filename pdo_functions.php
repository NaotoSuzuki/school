<?php



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
