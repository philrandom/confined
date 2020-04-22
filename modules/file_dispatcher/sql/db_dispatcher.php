<?php
class db_dispatcher
{

    public $cnnx;


		function __construct(){
		  $this->cnnx  = new PDO(const_dispatcher::type_sql.':dbname='.const_dispatcher::dbname.';host='.const_dispatcher::server, const_dispatcher::user_sql, const_dispatcher::pass_sql);
		}

		function kill(){
      $this->cnnx = null;
		}

/*--------------------------
SECTION search for dispatcher:__construct
--------------------------*/
		function search_by_hash($h_code){
			$sql = $this->cnnx->prepare("SELECT tag FROM ".const_dispatcher::tag_table." WHERE  h_code like :h_code order by weight asc");
			$sql->execute([':h_code' => $h_code]);
			//print_r($sql->errorInfo());
			$tab = $sql->fetchAll();
			$final = array();
			foreach ($tab as $elem) {
				$final[] = $elem['tag'];
			}
			//echo "[ok] search_by_hash";
			return $final;
		}

		function search_by_path($tree){
			/* example to search : C/network/socket/
			SELECT * FROM (
			SELECT count(h_code) C, h_code, tag, weight FROM `tag` where ( tag='C' and weight=0 ) or ( tag='network' and weight=1 ) or ( tag='socket' and weight=2 ) group by h_code
			) rep where C=3*/

			$str = "SELECT h_code FROM ( SELECT count(h_code) C, h_code, tag, weight FROM `" . const_dispatcher::tag_table . "` where ";
			for($i=0 ; $i < sizeof($tree); $i++) {
				$str = $str . "(tag = '". $tree[$i] ."'  and weight = ".$i.")";
				if($i != sizeof($tree)-1)		$str = $str . ' or ';
			}
			$str = $str. " group by h_code ) rep where C=".sizeof($tree);
			//echo $str;
			$sql = $this->cnnx->prepare($str);
			$sql->execute();
			$r = $sql->fetchAll();
			if(sizeof($r) != 1)
				return 'NOT_FOUND';
			else 
				return($r[0]['h_code']);
		}

/*--------------------------
SECTION versionnig for dispatcher:*_version
--------------------------*/
		function get_author($h_code){
			$sql = $this->cnnx->prepare("SELECT author  FROM `" . const_dispatcher::file_ref_table . "` where h_code=:h_code ");
			$sql->execute([':h_code'=>$h_code]);
			return $sql->fetchAll()[0]['author'];
		}

		function get_version($h_code){
			$sql = $this->cnnx->prepare("SELECT v FROM `" . const_dispatcher::file_ref_table . "` where active=1 and h_code=:h_code");
			$sql->execute([':h_code'=>$h_code]);
			return $sql->fetchAll()[0]['v'];
		}
		
		function get_last_version($h_code){
			$sql = $this->cnnx->prepare("SELECT v FROM `" . const_dispatcher::file_ref_table . "` where h_code=:h_code order by v desc limit 1");
			$sql->execute([':h_code'=>$h_code]);
			return $sql->fetchAll()[0]['v'];
		}
		
		function update_current_version($h_code,$v,$last_colab=1){
			//echo "sql update_current_version<br>";
			$sql = $this->cnnx->prepare("UPDATE `" . const_dispatcher::file_ref_table . "` SET active=0 where h_code=:h_code");
			$sql->execute([':h_code'=>$h_code]);
			
			
			$sql = $this->cnnx->prepare("SELECT * from `" . const_dispatcher::file_ref_table . "` where v=:v and h_code=:h_code");
			$sql->execute([':h_code'=>$h_code,':v'=>$v]);
			//print_r($sql->errorInfo());
			//print_r('for v='.$v.':'.$sql->fetchAll());
			if( sizeof($sql->fetchAll())==1 ){
				$sql = $this->cnnx->prepare("UPDATE `" . const_dispatcher::file_ref_table . "` SET active=1 where v=:v and h_code=:h_code");
				$sql->execute([':h_code'=>$h_code,':v'=>$v]);
				//print_r($sql->errorInfo());
			}
			else {
				//echo 'author#'.$this->get_author($h_code).'#';
				$author = $this->get_author($h_code);
				$sql = $this->cnnx->prepare("INSERT INTO `" . const_dispatcher::file_ref_table . "` (`h_code`, `author`, `last_colab`,`v`,`date`,`active`) VALUES (:h_code, :author, :last_colab, :v , :date , 1)"); // where v = :v and h_code = :h_code");
				$sql->execute([':h_code'=>$h_code, ':author' => $author, ':last_colab'=>$last_colab, ':v' => $v ,':date'=>time()]);
				//print_r($sql->errorInfo());
				//print_r($sql);
			}
		}

/*--------------------------
SECTION creation for dispatcher:__construct
--------------------------*/

		function create_file($h_code,$author){
			//echo 'create_file';
			$sql = $this->cnnx->prepare("INSERT INTO `" . const_dispatcher::file_ref_table . "` (`h_code`, `author`, `last_colab`, `v`, `date`, `active`) VALUES (:h_code, :author, :author, 0, :time, 1)");
			$sql->execute([':h_code' => $h_code , ':author' => $author, ':time' => time()  ]);
			//print_r($sql->errorInfo());
		}

		function create_path($h_code, $tree){
			//echo 'create_path';
			for ($i=0; $i < sizeof($tree) ; $i++) {
				$sql = $this->cnnx->prepare("INSERT INTO  `tag` (`h_code`, `tag`, `weight`) VALUES (:h_code, :tag, :w)");
				$sql->execute([':h_code' => $h_code , ':tag' => $tree[$i], ':w' => $i  ]);
				//print_r($sql->errorInfo());
			}
		}

}
?>
