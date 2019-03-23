<?php
    require_once("../controller/explain_controller.php");
    $genre = $_GET["name"];
    $explain_items = getExplainItems($genre);
    $title = $explain_items[0]["title"];
    $content = $explain_items[0]["content"];

?>

<html>

    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
    </head>
    <body>

        <h1><?php echo $title ?></h1>

        <?php echo $content ?>

    </body>
</html>
