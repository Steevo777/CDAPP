<?php

// You need to add server side validation and better error handling here

$data = array();
$postpictureID = "";

if(isset($_GET['files']))
{  
    $error = false;
    $files = array();

	$baseserverURL='/fups/';//For database name
	$uploaddir = './fups/';//For directory add

    // Orig $uploaddir = './uploads/';
    foreach($_FILES as $file)
    {
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
        {
            $files[] = $file['name'];
        }
        else
        {
            $error = true;
        }
    }
    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
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
		$expiredate = "" ;//$_POST['date'];//$_POST['expiredate'];
		$expirehour = date('Y-m-d H:i:s'); ;//$_POST['expirehour'];
		$date = date('Y-m-d H:i:s'); 
 		 
		
		
	// query
			$sql="INSERT INTO  `posts` (  `k1` ,  `userid` ,  `username` ,  `type` ,  `post` ,  `linkedpost` ,  `postpictureID` ,  `posturlID` , `smile` ,  `frown` , `sad` ,  `viewed` , `postvideoID` , `date`, `expiredate` ,  `expirehours` ) 
VALUES (NULL ,   :userid,  :username, :type,  :post, NULL , :postpictureID , NULL , 0 ,0 ,0,0 , NULL , :date, :expiredate,:expirehour);"; 
 
			//$sql = "INSERT INTO votes (postid,userid,vote,date) VALUES (:postid,:userid,:vote,:date)";
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':userid'=>$userid,':username'=>$username,':type'=>$type,':post'=>$post,':postpictureID'=>$postpictureID,':date'=>$date,':expiredate' =>$expiredate,':expirehour' =>$expirehour ));
		
			header('Content-Type: application/json');
			if ($result === true) {
				$data = array('success' => 'Form was submitted', 'formData' => $_POST['filename']);
    			//header('Cache-Control: no-cache, must-revalidate');
		    	//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		    	//$array = array();
				//$array['success'] = TRUE;
				//$array['qsuccess'] = $q;
				//echo json_encode($array);
			}
				//$array['result'] = $q; */
    	
}

echo json_encode($data);

?>