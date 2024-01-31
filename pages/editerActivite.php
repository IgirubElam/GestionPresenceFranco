<?php 
 session_start();
?>
<?php
	require_once('connexionbd.php');

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	$requeteAct =$BaseDonnee->query("SELECT * FROM `type_activite` WHERE Id_activite =" .$_GET['numActivite']. "");
	$type_activite=$requeteAct->fetch();

	$nomAct = $type_activite['Nom_type_activite'];
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	<title>Edition d'une activite</title>
</head>
<body>
	<?php include('menu.php'); ?>

	<div class="container">
		<div class="panel panel-primary margintop">
			<div class="panel-heading">Edition d'une activite</div>
			<div class="panel-body">
				<form method="post" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nom">Nom :</label>
						<input type="text" name="nomA" placeholder="Nom" autocomplete="off" class="form-control" value="<?php echo $nomAct ?>"/>
					</div>

					<button type="submit" name="envoyer" class="btn btn-success">
						<span class="glyphicon glyphicon-save"></span>
						Enregistrer
					</button>
					
				</form>
			</div>
			
		</div>
		
	</div>

	<?php
	if (isset($_POST['envoyer'])) {
		$nom = $_POST['nomA'];

		$UpdateA="UPDATE `type_activite` SET `Nom_type_activite`='$nom' WHERE `Id_activite`=" .$_GET['numActivite']. "";
		$BaseDonnee->exec($UpdateA);

	

		header('location:typeActivite.php');
	}
	
 ?>



</body>
</html>