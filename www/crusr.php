<?php

// You need to add server side validation and better error handling here
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


$data = array();

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
		$email = $_POST['add_email'];
		$pwd = $_POST['add_pwd'];
		$usr = $_POST['add_username'];
		$date = date('Y-m-d H:i:s'); 
		$ip = get_client_ip();
		
		//$email = 'test';
		//$pwd = 'test';
		//$usr = 'test';
		//$date = 'test'; 
		//$ip = 'test';
 		
		// query
			$sql="INSERT INTO  `people` (  `k1` ,  `username` ,  `password` ,  `IP` ,  `eml`,  `added` ) 
VALUES (NULL , :username, :password,  :ip, :eml, :added);"; 
 
			$q = $db1->prepare($sql);
			$result = $q->execute(array(':username'=>$usr,':password'=>$pwd,':ip'=>$ip,':eml'=>$email,':added' =>$date));
			
			//Get userId just add
			// query
			$sql = "SELECT k1 AS userid FROM people WHERE username= :username ";
			$q = $db1->prepare($sql);
			$q->execute(array(':username'=>$usr));
		
			$results=$q->fetch(PDO::FETCH_ASSOC);
			$usrId = $results['userid'];
		
			if ($result === true)
				{
				$sql="INSERT INTO  `secur` (  `k1` ,  `userid` ,  `username` ,  `allowUserId` , `postuserid`, `world` ,  `family` , `friends` ,  `party` ,  `private`, `added`) VALUES (NULL ,  :usid,  :username,  :usid, NULL, '1',  '1',  '1',  '1',  '1', :added);"; 
 				$q = $db1->prepare($sql);
				$result = $q->execute(array(':usid'=>$usrId,':username'=>$usr,':added' =>$date));
				}
		
			header('Content-Type: application/json');
			if ($result === true) {
				$data = array('success' => 'Form was submitted', 'email' => $email,'username' => $usr);
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