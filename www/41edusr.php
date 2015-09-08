<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$userid = $_POST['usrid'];
		// query
		$sql = "SELECT people.k1, people.username, secur.family, secur.friends, secur.party
FROM people
LEFT JOIN secur ON people.k1 = secur.userid
AND secur.allowuserid = :userId
ORDER BY people.username";
		$q = $db1->prepare($sql);
		$q->execute(array(':userId'=>$userid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>