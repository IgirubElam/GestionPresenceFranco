<?php 
 session_start();
?>
<?php
	require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	if (isset($_POST['envoyer'])) {
		$activite = $_POST['activite'];
		$dateAppel = $_POST['date'];
		$admin = $_POST['admin'];

		$requete = "insert into appel(`Id_type_activite`,`Date`,`Id_choriste`) values('$activite','$dateAppel','$admin')";
		$BaseDonnee->exec($requete);
		header("location:listeAppel.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des choristes</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		<div class="panel panel-primary margintop">
			<div class="panel-heading"> Creation de l'appel </div>
			<div class="panel-body">
				<form method="post" class="form">
					<div class="form-group">
						<label for="nom">Activite :</label>
						<select class="form-control" name="activite">
							<option>Choisissez l'activite</option>
							<?php
								$requete="SELECT * from type_activite";
								$resultat=$BaseDonnee->query($requete);
								while ($enr=$resultat->fetch()) {
									echo '<option value='.$enr['Id_activite'].'>'.$enr['Nom_type_activite'].' </option>';	
								}
								
							?>

						</select>	
					</div>
					<div class="form-group">
						<label for="nom">Date :</label>
						<input type="date" name="date" autocomplete="off" class="form-control" />
					</div>
					<div class="form-group">
						<label for="nom">Admin :</label>
						<select class="form-control" name="admin">
							<option>Choisissez votre nom</option>
							<?php
								$requeteC="SELECT * from choriste where Is_admin=true";
								$resulta=$BaseDonnee->query($requeteC);
								while ($admin=$resulta->fetch()) {
									echo '<option value='.$admin['Id_choriste'].'>'.$admin['Nom'].' '.$admin['Prenom'].' </option>';	
								}
							?>
						</select>
					</div>
					
					<button type="submit" name="envoyer" class="btn btn-success">
						<span class="glyphicon glyphicon-save"></span>
						Enregistrer
					</button>

				</form>
			</div>
				

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
</body>
</html>