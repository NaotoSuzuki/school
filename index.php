<?php
require_once("grammer_class.php");
// エラー表示なし
ini_set('display_errors', 0);
ini_set('display_errors', 1);

class Index{
  private $grammer;
  private $grammerValue;

  public function construct($grammer,$grammerValue){
    $this->grammer=$grammer;
    $this->grammerValue=$grammerValue;
  }

  public function getGrammer(){
    return $this->grammer;
  }

  public function getGrammerValue(){
    return $this->grammerValue;
  }

}

$beverb=new Index('Be動詞');
$verb=new Index('一般動詞');
$pronoun=new Index('代名詞');
$thirdPerson=new Index('三人称単数');
$can=new Index('Can');




$beverbValue=new Index('beverb');
$verbValue=new Index('verb');
$pronounValue=new Index('pronoun');
$thirdPersonValue=new Index('thirdperson');
$canValue=new Index('can');

$grammerIndicate=array($beverb=>"beverb",$verb=>"verb",$pronoun=>"pronoun",$thirdPerson,$can);


?>

<HTMl>

    <head>
      <meta charset="utf-8">
       <title>Be.you</title>
       <link rel="stylesheet" type="text/css" href="style.css">
   </head>

   <body>

        <header>
        <h1>Welcome to Be.You</h1>
        </header>

        <div class="container">
          <?php foreach($grammerValues as $grammerValue):?>
            <!--DBから持ってくるか配列を作るか・・・配列を作ろう-->
                <div class="item">
                  <a href="grammer.php?name=<?php echo $grammerValue->getGrammerValue(); ?>">
          <?php endforeach?>
                    <!--grammer_class_phpのリストを参考に連想配列を作り、keyとvalueをそれぞれechoさせる。他に方法あるだろうけど-->
                  <?php foreach($grammers as $grammer):?>
                    <?php var_dump($grammers)?>
                    <p><?php echo $grammer->getGrammer();?></p>
                  </a>
                </div>

          <?php endforeach?>
        </div>

      </body>
</HTMl>
