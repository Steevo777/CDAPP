<?php // You need to add server side validation and better error handling here

//$data = array();


//$post = array();
$expiredate = "";//$_POST['expiredate'];
$expirehour = "";//$_POST['expirehour'];
$date = date('Y-m-d H:i:s'); 
   
$type = 'P'; 

$post = "";//$_POST['name'];
//$files = $_FILES['file_upload'];

//$foreach ($files as $key=>val){
    //...
//}

$data = array();

if(isset($_GET['files']))
//if(isset($_FILES['file_upload']))

{	
	$error = false;
	$files = array();
	
	$baseserverURL='/fups/';//For database name
	$uploaddir = './fups/';//For directory add
	foreach($_FILES as $file)
	{
		if(move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name'])))
		{
			$files[] = $uploaddir.$file['name'];
			$postpictureID = $baseserverURL.basename($file['name']);
		}
		else
		{
		    $error = true;
		}
		
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
			  
			
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else
{
	$data = array('success' => 'Form was submitted', 'formData' => $_POST);
}

echo json_encode($data);

?>