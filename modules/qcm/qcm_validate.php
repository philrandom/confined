<?php
    $z = new dispatcher("../data",$_POST['h_code'],'u');
	if( $z->add_row_qcm($_POST['qu'],$_POST['A'],$_POST['B'],$_POST['C'],$_POST['D'],$_POST['V']) )
	{
		foreach($z->get_all_row_qcm() as $quest) {
			echo "<div class=div-bloc-question>".$quest['question']."<br>";
			echo "<div class='response'>A ".$quest['A']."</div>";
			echo "<div class='response'>B ".$quest['B']."</div>";
			echo "<div class='response'>C ".$quest['C']."</div>";
			echo "<div class='response'>D ".$quest['D']."</div></div>";
		}
	}
	else
	{
		echo "error during submit your QCM test";
	}
