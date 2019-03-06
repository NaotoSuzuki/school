<?php
 require_once("../pdo_class.php");

  $error = $title = $content = '';
  if (@$_POST['submit']) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    if (!$title) $error .= 'タイトルがありません。<br>';
    if (mb_strlen($title) > 80) $error .= 'タイトルが長すぎます。<br>';
    if (!$content) $error .= '本文がありません。<br>';
    if (!$error) {
      $pdo = new PdoClass();
      $st = $pdo->query("INSERT INTO post(title,content) VALUES('$title','$content')");
      header('Location: blog.php');
      exit();
    }
  }
  require 'post.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>記事投稿 | Special Blog</title>
<link rel="../blog_style.css" href="blog.css">
</head>
<body>
<form method="post" action="post.php">
  <div class="post">
    <h2>記事投稿</h2>
    <p>題名</p>
    <p><input type="text" name="title" size="40" value="<?php echo $title ?>"></p>
    <p>本文</p>
    <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
    <p><input name="submit" type="submit" value="投稿"></p>
    <p><?php echo $error ?></p>
  </div>
</form>
</body>
</html>
