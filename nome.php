
<?php
	if ( isset($_SESSION["nome"]) ) {
		
		echo $_SESSION["nome"];
		
	}
	else {
	
		
			
		echo "<script> 
				location.href = ('login.php') 
			  </script>";
	}
?>