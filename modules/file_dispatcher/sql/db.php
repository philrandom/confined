<?php
class connection
{

    public $cnnx;

    function __construct()
    {
      	$this->cnnx  = new PDO('mysql:dbname=confined;host=localhost', 'confined', 'confined0');
    }

   function kill()
    {
        $this->cnnx = null;
    }

		function search_by_hash($h_code,$tree_structure)
		{
			//TODO verify type $h_code
			$sql_text = "SELECT ";
			for ($i=1; $i < sizeof($tree_structure) ; $i++) {
				$sql_text = $sql_text." ".$tree_structure[$i];
				if ( $i != sizeof($tree_structure) )
				{
					$sql_text = $sql_text.",";
				}
			}

			$sql_text = " FROM $tree_structure[0] WHERE  key =".$h_code;

			$sql = $this->cnnx->prepare($sql_text);
			$sql->execute();
			echo $sql_text;
			$type = $sql->fetchAll();

		}



}
