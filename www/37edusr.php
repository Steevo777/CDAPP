<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$userid = $_POST['usrid'];
		// query
		$sql = "select people.k1,people.username,secur.family,secur.friends,secur.party from people LEFT JOIN secur ON people.k1 = secur.allowuserid AND secur.userid = :userId
 ORDER By people.username";
		$q = $db1->prepare($sql);
		$q->execute(array(':userId'=>$userid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>