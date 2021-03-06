<?php
//require("../etc/sql.php");
class db_dispatcher
{

    public $cnnx;


		function __construct(){
			$this->cnnx  = new PDO(constant('type_sql').':dbname='.constant('dbname').';host='.constant('server'), constant('user_sql'), constant('pass_sql'));
		}

		function kill(){
      		$this->cnnx = null;
		}



/*--------------------------
SECTION search for dispatcher:__construct
--------------------------*/
		function search_by_hash($h_code){
			$sql = $this->cnnx->prepare("SELECT tag FROM tag WHERE h_code like :h_code order by weight asc");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
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
			$str = "SELECT h_code FROM ( SELECT count(h_code) C, h_code, tag, weight FROM tag where ";
			for($i=0 ; $i < sizeof($tree); $i++) {
				$str = $str . "(tag = '". $tree[$i] ."'  and weight = ".$i.")";
				if($i != sizeof($tree)-1)		$str = $str . ' or ';
			}
			$str = $str." group by h_code ) rep where C=".sizeof($tree);
			//echo '<br>FIRST REQ'.$str;
			$sql = $this->cnnx->prepare($str);
			$sql->execute();
			$r1 = $sql->fetchAll();

			$str = "SELECT h_code FROM ( SELECT count(h_code) C, h_code, tag, weight FROM tag where ";
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
			$str = "SELECT h_code FROM ( SELECT count(h_code) C, h_code, tag, weight FROM tag where ";
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
			$sql = $this->cnnx->prepare("SELECT author  FROM file_ref where h_code=:h_code ");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
			return $sql->fetchAll()[0]['author'];
		}

		function get_version($h_code){
			$sql = $this->cnnx->prepare("SELECT v FROM file_ref where h_code=:h_code and active=1");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute() or die(print_r($sql->errorInfo(), true));
			return $sql->fetchAll()[0]['v'];
		}
		
		function get_last_version($h_code){
			$sql = $this->cnnx->prepare("SELECT v FROM file_ref where h_code=:h_code order by v desc limit 1");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
			return $sql->fetchAll()[0]['v'];
		}
		
		function update_current_version($h_code,$v,$last_colab=1){
			//echo "sql update_current_version<br>";
			$sql = $this->cnnx->prepare("UPDATE file_ref SET active=0 where h_code=:h_code");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();

			$sql = $this->cnnx->prepare("SELECT * from file_ref where v=:v and h_code=:h_code");			
			$sql->bindParam(':v', $v);
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
			//print_r($sql->errorInfo());
			//print_r('for v='.$v.':'.$sql->fetchAll());
			if( sizeof($sql->fetchAll())==1 ){
				$sql = $this->cnnx->prepare("UPDATE file_ref SET active=1 where v=:v and h_code=:h_code");
				$sql->bindParam(':v', $v);
				$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
				$sql->execute();
				//print_r($sql->errorInfo());
			}
			else {
				//echo 'author#'.$this->get_author($h_code).'#';
				$author = $this->get_author($h_code);
				$sql = $this->cnnx->prepare("INSERT INTO file_ref (`h_code`, `author`, `last_colab`,`v`,`date`,`active`) VALUES (:h_code, :author, :last_colab, :v , :date , 1)"); // where v = :v and h_code = :h_code");
				$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
				$sql->bindParam(':author', $author);
				$sql->bindParam(':last_colab', $last_colab);
				$sql->bindParam(':v', $v);
				$sql->bindParam(':date', time());
				$sql->execute();
				//print_r($sql->errorInfo());
				//print_r($sql);
			}
		}

/*--------------------------
SECTION creation for dispatcher:__construct
--------------------------*/

		function create_file($h_code,$author){
			//echo 'create_file';
			$sql = $this->cnnx->prepare("INSERT INTO file_ref (`h_code`, `author`, `last_colab`, `v`, `date`, `active`) VALUES (:h_code, :author, :author, 0, :time, 1)");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->bindParam(':author', $author);
			$sql->bindParam(':time', time());
			$sql->execute();
			//print_r($sql->errorInfo());
		}

		function create_path($h_code, $tree){
			//echo 'create_path';
			for ($i=0; $i < sizeof($tree) ; $i++) {
				$sql = $this->cnnx->prepare("INSERT INTO  `tag` (`h_code`, `tag`, `weight`) VALUES (:h_code, :tag, :w)");
				$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
				$sql->bindParam(':tag', $tree[$i]);
				$sql->bindParam(':w', $i);
				$sql->execute();
				//print_r($sql->errorInfo());
			}
		}
		
/*----------------------------
SECTION others function linked to fs
----------------------------*/
		function rm($h_code){
			$sql = $this->cnnx->prepare("DELETE FROM tag where h_code = :h_code ");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
			$sql = $this->cnnx->prepare("DELETE FROM file_ref where h_code = :h_code ");
			
			
			
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
		}

/*----------------------------
SECTION qcm
// ----------------------------*/

		function add_row_qcm_sql($h_code,$qu,$A,$B,$C,$D,$V) {
			$sql = $this->cnnx->prepare("INSERT INTO qcm (`h_code`, question, A, B, C, D, V ) VALUES (:h_code, :question, :A, :B, :C, :D, :V)");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->bindParam(':question', $qu);
			$sql->bindParam(':A', $A);			
			$sql->bindParam(':B', $B);			
			$sql->bindParam(':C', $C);			
			$sql->bindParam(':D', $D);			
			$sql->bindParam(':V', $V);			
			return $sql->execute();
		}


		function get_all_row_qcm_sql($h_code) {
			$sql = $this->cnnx->prepare("SELECT * from qcm where h_code=:h_code");
			$sql->bindParam(':h_code', $h_code, PDO::PARAM_STR, 32);
			$sql->execute();
			return $sql->fetchAll();
		}
/*--------------------------
SECTION dashboard - score QCM
--------------------------*/
//this section is not present in file_dispatcher/main.php

		function get_userid($user) {
			$str = "SELECT iduser FROM user where user=:user";
			$sql = $this->cnnx->prepare($str);
			$sql->bindParam(':user', $user);
			$sql->execute();
			return $sql->fetchAll()[0]['iduser'];
		}

		function score_global_qcm($user) {
			$str = "SELECT count(h_code) c FROM score where iduser=:iduser";
			$sql = $this->cnnx->prepare($str);
			$id_user = $this->get_userid($user);
			$sql->bindParam(':iduser', $id_user);
			$sql->execute();
			return $sql->fetchAll()[0]['c'];
		}

		function get_all_correct_grid_qcm($user) {
			$str = "SELECT h_code FROM score where iduser=:iduser";
			$sql = $this->cnnx->prepare($str);
			$id_user = $this->get_userid($user);
			$sql->bindParam(':iduser', $id_user);
			$sql->execute();
			return $sql->fetchAll();
		}


		function get_number_of_grid_qcm() {
			$str = "SELECT count(h_code) maximum_grid FROM (SELECT * FROM `qcm` GROUP by h_code) r;";
			$sql = $this->cnnx->prepare($str);
			$sql->execute();
			return $sql->fetchAll()[0]['maximum_grid'];
		}

	


/*--------------------------------
SECTION dashboard - commits
--------------------------------*/
		function get_all_articles() {
			$str = "SELECT h_code FROM file_ref GROUP BY h_code";
			$sql = $this->cnnx->prepare($str);
			$sql->execute();
			$all_arts_sql = $sql->fetchAll();
			$all_arts = array();
			foreach( $all_arts_sql as $tmp)
				$all_arts[] = $tmp['h_code'];
			return $all_arts;
		}


}

?>
