<?php
	include('db.php');
	if($con)
	{
		$Query = "SELECT * FROM userLogin WHERE userRole = 'SYSTEM ADMINISTRATOR' AND status = 'ACTIVE'";
		$Result = $con->query($Query);
		if( $Result-> num_rows < 1)
		{
			echo "<script>location='addDefaultAdmin.php';</script>";
		}
	}

	
?>