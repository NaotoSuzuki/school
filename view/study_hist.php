<?php
    session_start();
    require_once("../controller/study_hist_controller.php");
    $user_id = $_SESSION["ID"];
    $hist_arrays=histInit($user_id);

 ?>


<html>
    <head>
        <meta charset="utf-8">
		<title>Be.you</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
    </head>

    <body>
        <?php echo $_SESSION["NAME"]."さんの学習記録"?>
            <div class="container">
                <?php $time = 0 ?>
                    <?php foreach($hist_arrays as $hist_array): ?>
                        <?php if($time == 0 || $time !== $hist_array["created"]) :?>
                            <div class="item">
                                 <a href = "study_hist_detail.php?name=<?php  echo $hist_array["created"]; ?>">
                                    <p><?php echo $hist_array["genre"]."　".$hist_array["created"] ?></p>
                                </a>
                            </div>
                        <?php endif ?>
                    <?php $time = $hist_array["created"]?>
                <?php endforeach?>
            </div>
        </body>
</html>
