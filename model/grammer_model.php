<?php
    function getGrammer(){
        try {
            $dbh = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
            $sql = "SELECT genres.id , genres.genre, genres.genre_value FROM  genres order by id";
            $res = $dbh->query($sql);
            $records = $res->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e) {
            	echo $e->getMessage();
            	die();
            }
            return array_column($records, 'genre','genre_value');
        }
