<?php

// You need to add server side validation and better error handling here

    // Insert notifi into database
	try{
		$db1 = new PDO('mysql:host=mysql15.powweb.com;dbname=chatdawg','cdsuperuser','ainfo10c');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		die();
		}
	
		//Get the form data
		$userId = $_POST['usrid'];	//148
		$req = $_POST['req']; //ei. = remp147
		$post = "Request";
		$postpictureID = "";
		$expiredate = "" ;//$_POST['date'];//$_POST['expiredate'];
		$expirehour = "";//$_POST['expirehour'];
		$date = date('Y-m-d H:i:s');
                
                $userRequested = substr($req,4); 
                $userAllowed = $userId;
 
		
		//Get user name
		$sql = "SELECT DISTINCT people.username AS username FROM people WHERE k1 = :userid";
		$q = $db1->prepare($sql);
		$q->execute(array(':userid'=>$userAllowed));
	
		$results=$q->fetch();
		$username = $results['username'];
		
		
		//Check for secur record already created if not create secur for user right
		$sql = "SELECT secur.k1 AS k1 FROM secur WHERE allowUserID = :allowUserId AND userID = :userId";
		$q = $db1->prepare($sql);
		$q->execute(array(':userId'=>$userRequested,':allowUserId'=>$userAllowed));
	
		$results=$q->fetch();
		if ((is_array($results)) ) {
  			$securK1 = $results['k1']; //Key to update
		}
		else
		{
			//Create user rights allow record
			$sql="INSERT INTO  `secur` (  `k1` ,  `userid` ,  `username` ,  `allowUserId` ,  `allowUserType` ,  `world` ,  `family` ,  `friends` ,  `party` ,  `private` ,  `type` ,  `postuserid` ,  `added` ) 
                  VALUES ( NULL ,  :userid ,  :username,  :allowUserID, NULL , NULL ,  '0',  '0',  '0', NULL ,  :type, NULL , :date);"; 
 
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':userid'=>$userRequested,':username'=>$username,':type'=>substr($req,0,4),':allowUserID'=>$userAllowed,':date'=>$date));
		} 
		
		$group = "";
		$post = "";
		
			
		
		
		if (substr($req,0,3) == "req")
		{
			if (substr($req,3,1) == "a") 
			{
				$group = "family";
			}
			
			if (substr($req,3,1) == "f") 
			{
				$group = "friend";
			}
			
			if (substr($req,3,1) == "p") 
			{
				$group = "party";
			}
			
			
			$post = " would like to be added into your ".$group;
		}
 		 
		//To following or revoke from I Can See
		if (substr($req,0,3) == "rev")
		{
			if (substr($req,3,1) == "a")
			{
				$updateField = "family";
				$trueValue = "0";
			}
			
			if (substr($req,3,1) == "f")
			{
				$updateField = "friends";
				$trueValue = "0";
			}
			
			if (substr($req,3,1) == "p")
			{
				$updateField = "party";
				$trueValue = "0";
			}
		
			$sql="update  `secur` set `".$updateField."`= :trueValue WHERE `userid`= :userId AND `allowUserId` = :allowUserId ;"; 
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':trueValue'=>$trueValue,':userId' =>$userRequested,'allowUserId' =>$userAllowed));
		}
		
		
		
		//Remove rights -- sorry -- No user approval needed -- process stops here
		if (substr($req,0,3) == "rem")
		{
			if (substr($req,3,1) == "a")
			{
				$updateField = "family";
				$trueValue = "0";
			}
			
			if (substr($req,3,1) == "f")
			{
				$updateField = "friends";
				$trueValue = "0";
			}
			
			if (substr($req,3,1) == "p")
			{
				$updateField = "party";
				$trueValue = "0";
			}
		
			$sql="update  `secur` set `".$updateField."`= :trueValue WHERE `userid`= :userId AND `allowUserId` = :allowUserId ;"; 
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':trueValue'=>$trueValue,':userId' =>$userAllowed,'allowUserId' =>$userRequested));
		}
		else //add the a record for Approval of user 
		{		
	// query
			$sql="INSERT INTO  `notifi` (  `k1` ,  `userid` ,  `username` ,  `type` ,  `post` ,  `linkedpost` ,  `postpictureID` ,  `posturlID` , `smile` ,  `frown` , `sad` ,  `viewed` , `postvideoID` , `date`, `expiredate` ,  `expirehours`,  `allowUserId` ) 
VALUES (NULL ,   :userid,  :username, :type,  :post, NULL , :postpictureID , NULL , 0 ,0 ,0,0 , NULL , :date, :expiredate,:expirehour,:allowUserId);"; 
 
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':userid'=>$userRequested,':username'=>$username,':type'=>substr($req,0,4),':post'=>$post,':postpictureID'=>$postpictureID,':date'=>$date,':expiredate' =>$expiredate,':expirehour' =>$expirehour,':allowUserId' =>$userAllowed ));
	 	}
		
		header('Content-Type: application/json');
		if ($result === true) {
			$data = array('success' => 'Form was submitted', 'formData' => $userRequested);
			//header('Cache-Control: no-cache, must-revalidate');
	    	//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	    	//$array = array();
			//$array['success'] = TRUE;
			//$array['qsuccess'] = $q;
			//echo json_encode($array);
		}
			//$array['result'] = $q; */
    	


echo json_encode($data);

?>