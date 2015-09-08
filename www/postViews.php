<?php
	
	function updateViews($userId,$typeField,$lastKey)
	{
		include getcwd().'/dcnt20.php';
		try {
		
			$sql="update  `postviews` set `".$typeField."`= :keyValue WHERE `userid`= :userId;"; 
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':keyValue'=>$lastKey,':userId' =>$userId));
			return true;
			}
		catch (Exception $e) 
			{
			return false;
			}
	}
	
	function addViewed($postId,$userId,$allowUserId)
	{
		include getcwd().'/dcnt20.php';
		$date = date('Y-m-d H:i:s');
		try {
			
			$sql="INSERT INTO  `viewed` (  `k1` ,  `postid` ,  `userid` ,  `viewedby`,  `added` ) 
                  VALUES ( NULL , :postId, :userId ,  :allowUserId, :date);";  
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':postId'=>$postId,':userId' =>$userId,':allowUserId' =>$allowUserId,':date' =>$date));
			return true;
			}
		catch (Exception $e) 
			{
			return false;
			}	
	} 
		
?>