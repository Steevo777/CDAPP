<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$postid = $_POST['postid'];
		// query
		$sql = "SELECT DISTINCT people.username AS username FROM viewed, people WHERE viewed.postid = :postid AND viewed.viewedby = people.k1 ORDER BY people.username ASC";
		$q = $db1->prepare($sql);
		$q->execute(array(':postid'=>$postid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>