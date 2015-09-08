<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$username = $_POST['usid'];
		// query
		$sql = "SELECT * , posts.username AS postuser, posts.k1, (SELECT COUNT( * ) FROM viewed WHERE posts.k1 = viewed.postid) AS views AS postid FROM posts
WHERE posts.type =  'W' ORDER BY DATE DESC";
		$q = $db1->prepare($sql);
		$q->execute(array(':username'=>$username));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
?>