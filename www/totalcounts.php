<?php
	header('Content-Type: application/json');
	include getcwd().'/dcnt20.php';
	
		//Get the form data	
		$userId = $_POST['usid'];
		// query
		//$sql = "SELECT `username` FROM `people` WHERE `eml` = :eml AND `password` = :pwd";
		$sql = "SELECT (Select count(*) FROM posts WHERE type =  'W' and userid=:userid) as worldcount,(Select count(*) FROM posts, secur,postviews WHERE secur.allowuserid = :userid AND posts.userid = secur.userid AND secur.allowuserid = postviews.userid
		AND posts.type =  'A' AND secur.family = '1' AND posts.k1 > postviews.family) as familycount,(Select count(*) FROM posts, secur,postviews WHERE secur.allowuserid = :userid AND posts.userid = secur.userid AND secur.allowuserid = postviews.userid
		AND posts.type =  'F' AND secur.friends = '1' AND posts.k1 > postviews.friends) as friendscount,(Select count(*) FROM posts, secur,postviews WHERE secur.allowuserid = :userid AND posts.userid = secur.userid AND secur.allowuserid = postviews.userid
		AND posts.type =  'P' AND secur.party = '1' AND posts.k1 > postviews.party) as partycount,(Select count(*) FROM notifi WHERE userid=:userid) as privatecount ";
		$q = $db1->prepare($sql);
		$q->execute(array(':userid'=>$userId));
		$result= $q->fetch();

 		if($result)
 		{
			$data = array('success' => 'Form was submitted', 'worldcount' => $result['worldcount'],'familycount' => $result['familycount'],'friendscount' => $result['friendscount'],'partycount' => $result['partycount'],'privatecount' => $result['privatecount']);
		}
	echo json_encode($data);
?>