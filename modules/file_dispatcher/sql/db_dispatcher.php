<?php
//require("../etc/sql.php");
class db_dispatcher
{

    public $cnnx;


		function __construct(){
			$this->cnnx  = new PDO(const_sql::type_sql.':dbname='.const_sql::dbname.';host='.const_sql::server, const_sql::user_sql, const_sql::pass_sql);
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
			$tab = $sql->fetchAll();
			$final = array();
			foreach ($tab as $elem) {
				$final[] = $elem['tag'];
			}
			return $final;
		}

		function search_by_path($tree,$restrict=0){
			//echo 'entry sbp';
			$r = $this->search_by_path_kern($tree,$restrict);
			if(sizeof($r) == 1)
				return($r[0]);
			else
				return 'NOT_FOUND';
		}

		
		function search_by_path_refiltered($tree,$restrict=0){
			return $this->search_by_path($tree,$restrict);
		}

		function search_by_path_kern($tree,$restrict=0){
			$restrict = 0;
			//echo 'entry sbpk';
			//print_r($tree);
			/* EXAMPLE TREE
			/OS/
				linux/
				bsd/
					macOS/
			*/


			//[OK] /OS/linux/
			//[OK] /OS/bsd/macOS/
			//[FAIL] /OS/bsd/
			$str = "SELECT h_code FROM ( SELECT count(h_code) C, h_code, tag, weight FROM `" . const_dispatcher::tag_table . "` where ";
			for($i=0 ; $i < sizeof($tree); $i++) {
				$str = $str . "(tag = '". $tree[$i] ."'  and weight = ".$i.")";
				if($i != sizeof($tree)-1)		$str = $str . ' or ';
			}
			$str = $str." group by h_code ) rep where C=".sizeof($tree);
			//echo '<br>FIRST REQ'.$str;
			$sql = $this->cnnx->prepare($str);
			$sql->execute();
			$r1 = $sql->fetchAll();

			$str = "SELECT h_code FROM ( SELECT count(h_code) C, h_code, tag, weight FROM `" . const_dispatcher::tag_table . "` where ";
			for($i=0 ; $i < sizeof($tree); $i++) {
				$str = $str . "(tag = '". $tree[$i] ."'  and weight = ".$i.")";
				if($i != sizeof($tree)-1)		$str = $str . ' or ';
			}
			$str = $str." or weight= ". sizeof($tree) ." group by h_code ) rep where C=".(sizeof($tree)+1);
			//echo '<br>SECOND REQ'.$str;
			$sql = $this->cnnx->prepare($str);
			$sql->execute();
			$r2 = $sql->fetchAll();

			//CLEANING
			$r1_clean = array();
			$r2_clean = array();
			foreach($r1 as $r1tmp)
				$r1_clean[] = $r1tmp['h_code'];
			foreach($r2 as $r2tmp)
				$r2_clean[] = $r2tmp['h_code'];

			$r = array();
			foreach( $r1_clean as $r1_elem )
				if(!in_array($r1_elem,$r2_clean))
					$r[] = $r1_elem;

			return $r;
		
		}
		
		function summary($tree){
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
			return($r);
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
		
/*----------------------------
SECTION others function linked to fs
----------------------------*/
		function rm($h_code){
			$sql = $this->cnnx->prepare("DELETE FROM `" . const_dispatcher::tag_table . "` where h_code = :h_code ");
			$sql->execute([':h_code' => $h_code ]);
			$sql = $this->cnnx->prepare("DELETE FROM `" . const_dispatcher::file_ref_table . "` where h_code = :h_code ");
			$sql->execute([':h_code' => $h_code ]);
		}

/*----------------------------
SECTION qcm
// ----------------------------*/

		function add_row_qcm_sql($h_code,$qu,$A,$B,$C,$D,$V) {
			$sql = $this->cnnx->prepare("INSERT INTO `" . const_dispatcher::qcm . "` (`h_code`, question, A, B, C, D, V ) VALUES (:h_code, :question, :A, :B, :C, :D, :V)");
			return $sql->execute([':h_code'=>$h_code, ':question'=>$qu, ':A' => $A, ':B' => $B, ':C' => $C, ':D' => $D, ':V'=>$V]);
		}


		function get_all_row_qcm_sql($h_code) {
			$sql = $this->cnnx->prepare("SELECT * from `" . const_dispatcher::qcm . "` where h_code=:h_code");
			$sql->execute([':h_code'=>$h_code]);
			return $sql->fetchAll();
		}


}

?>
