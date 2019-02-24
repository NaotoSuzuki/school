<?php
$a=1;
var_dump($a);

class PdoClass{

    private $dbh;
    private $sql;

    public function __construct(){
        $user = "test";
        $pass = "test";
        $this->dbh =new PDO('mysql:host=localhost;dbname=beyou;charset=utf8', $user, $pass);
    }

    public function closePDO(){
        $this->dbh = null;
    }

    public function setSql($sql){
        $this->sql = $sql;
    }


  /**
  * $sql: string
  * $param_array: array(string =>string)
  * retrun array(array(string =>string))
  */
    public function getRecord($sql,$param_array){
        try{
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setSql($sql);
            $stmt = $this->dbh->prepare($this->sql);
            foreach ($param_array as $key => &$value) {
                $stmt ->bindparam(':'.$key, $value);
            }
            $stmt ->execute();

            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // $this->closePDO();
            return $records;
        }catch(Exception $e){
            throw new PDOException($e, 1);
        }
    }

    /**
    * $sql: string
    * $param_array: array(string =>string)
    * retrun none
    */
    public function insertRecord($sql,$param_array){
        try{
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setSql($sql);
            $stmt = $this->dbh->prepare($this->sql);

            foreach ($param_array as $key => &$value) {
                $stmt ->bindparam(":".$key, $value);
            }
            $stmt ->execute();
            // $this->closePDO();
        }catch(Exception $e){
            throw new PDOException($e, 1);
        }
    }

}

?>
