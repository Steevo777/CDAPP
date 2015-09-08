<?php
	include getcwd().'/postViews.php';
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$userid = $_POST['usrid'];
		$startKey = $_POST['SK'];
		$limit = $_POST['LT'];
		
		// query
		$sql = "SELECT *,posts.username AS postuser,posts.k1 AS postid, (SELECT COUNT( * ) FROM viewed WHERE posts.k1 = viewed.postid) AS views FROM posts, secur WHERE secur.allowuserid = :userid AND posts.userid = secur.userid 
		AND posts.type =  'P' AND secur.party = '1' AND CAST(posts.k1 as UNSIGNED) > ".$startKey." ORDER BY posts.date DESC LIMIT ".$limit;
		$q = $db1->prepare($sql);
		$q->execute(array(':userid'=>$userid));
	
		$results=$q->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($results as $row) {
			addViewed($row['postid'],$row['userid'],$row['allowUserId']);
		};
		
				
		//Update Views with highest number viewed
		$sql = "SELECT max(posts.k1) AS keyValue FROM posts, secur WHERE secur.allowuserid = :userid AND posts.userid = secur.userid 
		AND posts.type =  'P' AND secur.party = '1' AND CAST(posts.k1 as UNSIGNED) > ".$startKey." ORDER BY posts.date DESC LIMIT ".$limit;
		$q = $db1->prepare($sql);
		$q->execute(array(':userid'=>$userid));
		$resultViews=$q->fetch();
				
		updateViews($userid,'party', $resultViews['keyValue']);
		
		echo json_encode($results);
		
		
?>