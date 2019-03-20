<?php
require_once("../pdo_class.php");

function indicateIndex(){
    try {
    	$dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
        $sql = "SELECT genres.id , genres.genre, genres.genre_value FROM  genres order by id";
    	$lessons = $dbh->query($sql);
        } catch(PDOException $e) {
        	echo $e->getMessage();
        	die();
        }
    return $lessons;
}
