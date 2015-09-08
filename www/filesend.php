<?php
$sessionID = $_POST['id'];
$files = "";//$_FILES['image'];
$type = "p";
$post = "";//$_POST['name'];
$postpictureID = "p";
$date = "p";
$expiredate = "p";
$expirehour = "p";

//$foreach ($files as $key=>val){
    //...
//}

// Insert post of picture into database
			try{
				$db1 = new PDO('mysql:host=mysql15.powweb.com;dbname=chatdawg','cdsuperuser','ainfo10c');
				$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				catch(PDOException $e)
				{
				echo $e->getMessage();
				die();
				}
				
			// query
			$sql="INSERT INTO  `posts` (  `k1` ,  `userid` ,  `username` ,  `type` ,  `post` ,  `linkedpost` ,  `postpictureID` ,  `posturlID` ,  `postvideoID` , `date`, `expiredate` ,  `expirehours` ) 
VALUES (NULL ,  '94',  'Superman', :type,  :post, NULL , :postpictureID , NULL , NULL , :date, :expiredate,:expirehour);"; 
 
			//$sql = "INSERT INTO votes (postid,userid,vote,date) VALUES (:postid,:userid,:vote,:date)";
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':type'=>$type,':post'=>$post,':postpictureID'=>$postpictureID,':date'=>$date,':expiredate' =>$expiredate,':expirehour' =>$expirehour ));
		
			header('Content-Type: application/json');
			if ($result === true) {
				header('Cache-Control: no-cache, must-revalidate');
		    	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		    	$array = array();
				$array['success'] = TRUE;
				$array['qsuccess'] = $q;
				echo json_encode($array);
			}
				$array['result'] = $q;
			  
			
	
	$data = array('success' => 'Form was submitted', 'formData' => $_POST);


echo json_encode($data);

?>