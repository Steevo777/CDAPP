<?php
//submit_files();
insert_sql();
test_function();

$postpictureID = "";

//Submit files
function submit_files() {
		if($_FILES['0']['name'])
		
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
			}
		}
}


if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "test": test_function(); break;
    }
  }
}

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function insert_sql(){
	
		$sessionID = "";$_POST['id'];
		$files = "";//$_FILES['image'];
		$type = "p";
		$post = $_POST['post'];
		//$postpictureID = "p";
		$date = "test";
		$expiredate = $_POST['date'];
		$expirehour = "p";
			
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


function test_function(){
  $return = $_POST;
  
  //Do what you need to do with the info. The following are some examples.
  //if ($return["favorite_beverage"] == ""){
  //  $return["favorite_beverage"] = "Coke";
  //}
  //$return["favorite_restaurant"] = "McDonald's";
  
  $return["json"] = json_encode($return);
  echo json_encode($return);
}


?>