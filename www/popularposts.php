<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$userid = $_POST['usrid'];
		// query
		//SELECT * FROM posts AS p, secur AS s WHERE s.userid =  AND p.userid = s.allowuserid
		//AND p.type =  'P' ORDER BY p.date DESC 
		$sql = "SELECT *,posts.username AS postuser,posts.k1 AS postid FROM posts, secur WHERE secur.userid = :userid AND posts.userid = secur.allowuserid 
		 AND (secur.family = '1' or secur.friends = '1' or secur.party = '1') ORDER BY posts.smile DESC ";
		$q = $db1->prepare($sql);
		$q->execute(array(':userid'=>$userid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>