<?php
// You need to add server side validation and better error handling here
$data = array();
$unid = "";

if(isset($_GET['files']))
	{  
		//Upload file first time in
		$baseserverURL='/fups/';//For database name
		$uploaddir = './fups/';//For directory add
	
	    foreach($_FILES as $file)
	    {
	        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
	        {
	            $unid = $file['name'];
	            $success = true;
	        }
	        else
	        {
	            $success = false;
	        }
	    }
	    
	    $data = $success ? array('file' => $unid,'status' => 'success') : array('file' => '','status' => 'error');
	}
	else
	{
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
		
			//Get the form data
			$username = $_POST['username'];
			$userid = $_POST['usid'];	
			$post = $_POST['name'];
			$type = $_POST['type'];
			$postpictureID = $_POST['filename'];
			$expiredate = "" ; /*$_POST['date']; $_POST['expiredate'];*/
			$expirehour = date('Y-m-d H:i:s'); //$_POST['expirehour'];
			$date = date('Y-m-d H:i:s'); 
	 		 
			//Exec query
			$sql="INSERT INTO  `posts` (  `k1` ,  `userid` ,  `username` ,  `type` ,  `post` ,  `linkedpost` ,  `postpictureID` ,  `posturlID` , `smile` ,  `frown` , `sad` ,  `viewed` , `postvideoID` , `date`, `expiredate` ,  `expirehours` ) 
	        VALUES (NULL ,   :userid,  :username, :type,  :post, NULL , :postpictureID , NULL , 0 ,0 ,0,0 , NULL , :date, :expiredate,:expirehour);"; 
	 		$q = $db1->prepare($sql);
			$success = $q->execute(array(':userid'=>$userid,':username'=>$username,':type'=>$type,':post'=>$post,':postpictureID'=>$postpictureID,':date'=>$date,':expiredate' =>$expiredate,':expirehour' =>$expirehour ));
				
			$data = $success ? array('file' => $postpictureID,'status' => 'success') : array('file' => '','status' => 'error');
	}	
		
	header('Content-Type: application/json');
	echo json_encode($data);
	
?>