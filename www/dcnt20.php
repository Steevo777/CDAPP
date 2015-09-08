<?PHP
	try {
		$db1 = new PDO('mysql:host=mysql15.powweb.com;dbname=chatdawg','cdsuperuser','ainfo10c');
		$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e)
		{
		echo ("Error");
		// echo error here
		die();
		}
?>		
		