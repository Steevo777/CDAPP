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
	
	$userIdE = $_POST['usrid']; //147
	$postId = $_POST['pstid']; //147
    $req = $_POST['req']; //apf148
    $date = date('Y-m-d H:i:s'); 
    
    //apf"+item.postid
    $allowUserId = substr($req,3);
	
	//See if there is a like response already If yes then unresponse
	//Get number and increase by one, Update the number 
			// query
	$sql = "SELECT * FROM secur WHERE userid= :userid AND allowUserID = :allowUserID ";
	$q = $db1->prepare($sql);
	$q->execute(array(':userid'=>$userIdE,':allowUserID'=>$allowUserId));

	$results=$q->fetch(PDO::FETCH_ASSOC);
	
	$type = substr($req,2,1); 	
	$updateField = "";
	
	
	if ($results)
		{
			if ($type == "a")
			{
				$updateField = "family";
				$trueValue = "1";
			}
			
			if ($type == "f")
			{
				$updateField = "friends";
				$trueValue = "1";
			}
			
			if ($type == "p")
			{
				$updateField = "party";
				$trueValue = "1";
			}
			
		
		$sql="update  `secur` set `".$updateField."`= :trueValue WHERE `userid`= :userid AND `allowUserId` = :allowUserId ;"; 
		$q = $db1->prepare($sql);
		$result = $q->execute(array(':trueValue'=>$trueValue,':userid' =>$userIdE,':allowUserId'=>$allowUserId));
		}
		
		$sql="delete from notifi;"; 
		$q = $db1->prepare($sql);
		$result = $q->execute();
		
		
		
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