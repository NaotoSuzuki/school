<?php
    require_once("../controller/explain_controller.php");
    function explainItemsInit($genre){
        try{
            $pdo = new PDO("mysql:host=localhost; dbname=beyou; charset=utf8", 'test', 'test');
            $sql = "SELECT
            explain_pages.title as title,
            explain_pages.content as content,
            explain_pages.genre as genre
            from explain_pages
            where genre = :genre
            ";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(":genre", $genre);
            $stmt->execute();
            $explain_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $explain_items;
    }
