<?php
session_start();

if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

require_once("../controller/index_controller.php");
$lessons = getIndexIndicate();

?>

<HTMl>
    <head>
      <meta charset="utf-8">
       <title>Be.you</title>
       <link rel="stylesheet" type="text/css" href="../style.css">
   </head>
   <body>
        <header>
           <h1><?php echo $_SESSION["NAME"]?>さん、Welcome to Be.You！</h1>
        </header>
        <div class="options">
            <a href="study_hist.php"><p>学習の進捗を確認する</p></a>
            <a href="Logout.php"><p>ログアウト</p></a>
        </div>
        <div class="container">
            <?php foreach($lessons as $values):?>
			<br>
			<br>
            <div class="item">
			  <a href="grammer.php?name=<?php echo $genre=$values['genre_value']; ?>">
				<?php echo $genre = $values['genre']; ?>
			  </a>
                  
			</div>
			<?php endforeach?>
        </div>
    </body>
</HTMl>
