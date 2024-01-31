<?php
	
	session_start();

	require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	$idCho=$_SESSION['idChoriste'];
	$oldpwd=isset($_POST['oldpwd'])?$_POST['oldpwd']:"";

	echo $idCho.'<br>';
	echo $oldpwd.'<br>';

	$newpwd=isset($_POST['newpassword'])?$_POST['newpassword']:"";

	$requete="select * from choriste where Id_choriste=$idCho and Password='$oldpwd' ";
	$resultat=$BaseDonnee->prepare($requete);
	$resultat->execute();

	$msg="";
	$interval=5;
	$url="login.php";

	if ($resultat->fetch()) {
		$requete="Update choriste set Password=? where Id_choriste=?";
		$parametres=array($newpwd,$idCho);
		$resultat=$BaseDonnee->prepare($requete);
		$resultat->execute($parametres);

		$msg="<div class='alert alert-success'>
					<strong>Felicitation!</strong>Votre mot de passe est modifie avec success
				</div>";
	}else {
		$msg="<div class='alert alert-danger'>
					<strong>Erreur!</strong>L'ancien mot de passe est incorrect !!!
				</div>";
		$url=$_SERVER['HTTP_REFERER'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Changement de mot de passe</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<?php include("menu.php"); ?>
	<div class="container">
		<br><br>
		<?php 
			echo $msg;
			header("refresh:$interval;url=$url");
		?>
		
	</div>
</body>
</html>