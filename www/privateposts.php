<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$userid = $_POST['usrid'];
		// query
		$sql = "SELECT *,notifi.username AS postuser,notifi.k1 AS postid FROM notifi WHERE userid = :userid ORDER BY notifi.date DESC ";
		$q = $db1->prepare($sql);
		$q->execute(array(':userid'=>$userid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>