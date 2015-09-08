<?php

	//$username = 'Superman';
	$username = $_POST['usid'];
	
	echo ('post value:'.$_POST['usid']);
		
	$dbcnx = @mysql_connect("mysql15.powweb.com","cdsuperuser", "ainfo10c");
     if (!$dbcnx) 
	 {    echo( "<PA>Unable to connect to the database server at this time.</PA>" );
	     exit();  }
    // Select the database
    if (! @mysql_select_db("chatdawg") )
	 {    echo( "<PA>Database is syncing at this time. Try again later. </PA>" );
	     exit();  }
    
    // Request the text of customer from login info  
    $sql = "SELECT (Select count(*) FROM posts WHERE type =  'W' and username='". $username ."') as worldcount,(Select count(*) FROM posts WHERE type =  'A' and username='". $username ."') as familycount,(Select count(*) FROM posts WHERE type =  'F' and username='". $username ."') as friendscount,(Select count(*) FROM posts WHERE type =  'P' and username='". $username ."') as partycount,(Select count(*) FROM posts WHERE type =  'R' and username='". $username ."') as privatecount ";
	$result = mysql_query($sql) ;
	  if (!$result) {echo("<P>Error performing projects query: ".mysql_error()."</P>");
	      exit();}
 		
	
	$rows = array();
	while($r = mysql_fetch_assoc($result)) {
	  $rows[] = $r;
	}
	
	echo json_encode($rows);
?>