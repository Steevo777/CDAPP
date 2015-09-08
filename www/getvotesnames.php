<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$postid = $_POST['postid'];
		// query
		$sql = "SELECT DISTINCT people.username AS username,votes.vote AS vote FROM votes,people WHERE votes.postid = :postid AND votes.userid = people.k1 order by votes.vote,people.username ASC";
		$q = $db1->prepare($sql);
		$q->execute(array(':postid'=>$postid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>