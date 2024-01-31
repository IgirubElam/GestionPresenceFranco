<?php 
 session_start();
?>
<?php
	require_once('connexionbd.php');

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	if (isset($_POST['envoyer'])) {
		$nomActivite = $_POST['nomA'];

		$requete= "insert into type_activite(`Nom_type_activite`) values ('$nomActivite')";
		$BaseDonnee ->exec($requete);
		header("location:typeActivite.php");
	}

	


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajout de la nouvelle activite</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		<div class="panel panel-primary margintop">
			<div class="panel-heading">Les informations de la nouvelle activite :</div>
			<div class="panel-body">
				<form method="post" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nom">Nom de la nouvelle activite :</label>
						<input type="text" name="nomA" placeholder="Nom activite" autocomplete="off" class="form-control" />
					</div>	

					<button type="submit" name="envoyer" class="btn btn-success">
						<span class="glyphicon glyphicon-save"></span>
						Enregistrer
					</button>
					
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>