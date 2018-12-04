<?php
ini_set('display_errors', 0);
ini_set('display_errors', 1);
class Index{
  private $grammer;
  // private $grammerValue;

  public function __construct($m){
    $this->grammer=$m;
    // $this->grammerValue=$grammerValue;
  }

  public function getGrammer(){
    return $this->grammer=$m;
  }

  // public function getGrammerValue(){
  //   return $this->grammerValue=$grammerValue;
  // }

}

$beverb=new Index('Be動詞');
$verb=new Index('一般動詞');
$pronoun=new Index('代名詞');
$thirdPerson=new Index('三人称単数');
$can=new Index('Can');

$grammers=array($beverb,$verb,$pronoun,$thirdPerson,$can);


// $beverbValue=new Index('beverb');
// $verbValue=new Index('verb');
// $pronounValue=new Index('pronoun');
// $thirdPersonValue=new Index('thirdperson');
// $canValue=new Index('can');
//
// $grammerValues=array($beverbValue,$verbValue,$pronounValue,$thirdPersonValue,$canValue);


?>


<?php foreach($grammers as $grammer):?>
<p><?php echo $grammer->getGrammer()?></p>
<?php endforeach?>
