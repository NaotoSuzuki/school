<?php
$grammerValue=$_GET['name'];
require_once("explain/$grammerValue.html");

?>
<div class="navigater"><a href="question.php?name=<?php echo $grammerValue;?>">問題を解く</a></div>
<div class="navigater"><a href="index.php">文法一覧に戻る</a></div>
