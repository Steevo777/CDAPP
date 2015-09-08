<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$eml = $_POST['inputEmail'];
		$pwd = $_POST['inputPassword'];
		
		// query
		$sql = "SELECT `username`,`k1` as userid FROM `people` WHERE `eml` = :eml AND `password` = :pwd";
		$q = $db1->prepare($sql);
		$q->execute(array(':eml'=>$eml,':pwd'=>$pwd));
		$done= $q->fetch();

 		if($done)
 		{
			$data = array('success' => 'Form was submitted', 'usrd' => $done['username'],'usrid' => $done['userid']);
		}
		
	echo json_encode($data);
?>