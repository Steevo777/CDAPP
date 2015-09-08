<?php

$data = array();
try{
	$db1 = new PDO('mysql:host=mysql15.powweb.com;dbname=chatdawg','cdsuperuser','ainfo10c');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		die();
		}
	
	$userIdE = $_POST['usrid']; 
    $voteE = $_POST['vote']; 
    
    //$userIdE = mysql_real_escape_string($userid);
    //$voteE = mysql_real_escape_string($vote);
    
    $postIdE = substr($voteE,1,strlen($voteE));
    
    $date = date('Y-m-d H:i:s'); 
	
	//See if there is a like response already If yes then unresponse
	//Get number and increase by one, Update the number 
			// query
	$sql = "SELECT * FROM posts WHERE k1= :postId ";
	$q = $db1->prepare($sql);
	$q->execute(array(':postId'=>$postIdE));

	$results=$q->fetch(PDO::FETCH_ASSOC);
	
	$voteType = substr($voteE,0,1); 	
	$updateField = "";
	$count = "";
	
	if ($results)
		{
			if ('s' == 's')
			{
				$updateField = "smile";
				$count = $results['smile'] + 1;
			}
			
			if ($voteType == 'f')
			{
				$updateField = 'frown';
				$count = $results['frown'] + 1;
			}
			
			if ($voteType == 'a')
			{
				$updateField = 'sad';
				$count = $results['sad'] + 1;
			}
			
		
		$sql="update  `posts` set `".$updateField."`= :count WHERE `k1`= :postId ;"; 
		$q = $db1->prepare($sql);
		$result = $q->execute(array(':count'=>$count,':postId' =>$postIdE));
		}
	
		
	
	 	// query
		$sql = "INSERT INTO votes (postid,userid,vote,date) VALUES (:postid,:userid,:vote,:date)";
		$q = $db1->prepare($sql);
		$result = $q->execute(array(':postid'=>$postIdE,':userid'=>$userIdE,':vote'=>$voteType,':date'=>$date));
		
		
		
		
		header('Content-Type: application/json');
			if ($result === true) {
				$data = array('success' => 'Success Update', 'username' => $userIdE);
    			//header('Cache-Control: no-cache, must-revalidate');
		    	//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		    	//$array = array();
				//$array['success'] = TRUE;
				//$array['qsuccess'] = $q;
				//echo json_encode($array);
			}

echo json_encode($data);

?>