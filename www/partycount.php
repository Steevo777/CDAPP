<?php

	$dbcnx = @mysql_connect("mysql15.powweb.com","cdsuperuser", "ainfo10c");
     if (!$dbcnx) 
	 {    echo( "<PA>Unable to connect to the database server at this time.</PA>" );
	     exit();  }
    // Select the database
    if (! @mysql_select_db("chatdawg") )
	 {    echo( "<PA>Database is syncing at this time. Try again later. </PA>" );
	     exit();  }
    
    // Request the text of customer from login info  
	$result = mysql_query("SELECT count(*) as count FROM posts WHERE type =  'P' ORDER BY username  ");
	  if (!$result) {echo("<P>Error performing projects query: ".mysql_error()."</P>");
	      exit();}
 		
	
	$count = "";
	while($row = mysql_fetch_assoc($result)) {
	  $count = $row["count"];
	}
	
	echo $count;
?>