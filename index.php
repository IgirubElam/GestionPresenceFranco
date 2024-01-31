<?php
	session_start();

	if ($_SESSION['is_admin']==1) {
		header("location:pages/listeAppel.php");
	}else{
		header("location:pages/mesPresences.php");
	}
		
?>