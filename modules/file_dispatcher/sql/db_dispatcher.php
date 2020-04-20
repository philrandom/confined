<?php
class db_dispatcher
{

    public $cnnx;

    function __construct(){
      	$this->cnnx  = new PDO('mysql:dbname=confined;host=localhost', 'confined', 'confined0');
    }

		function kill(){
        $this->cnnx = null;
		}

		function search_by_hash($h_code){
			//SELECT tag,weight FROM tag WHERE h_code like 'hello' order by weight asc
			$sql = $this->cnnx->prepare("SELECT * FROM tag WHERE  h_code like ':h_code' order by weight asc");
			$sql->execute([':h_code' => $h_code]);
			return $sql->fetchAll();
		}



}
?>
