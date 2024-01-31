<?php 
 session_start();
?>
<?php
	require_once('connexionbd.php');

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	//Pour l'affichage
	$requeteA =$BaseDonnee->query("SELECT * FROM `choriste` WHERE Id_choriste=" .$_GET['numChoriste']. "");
	$choriste=$requeteA->fetch();

	$nom = $choriste['Nom'];
	$prenom = $choriste['Prenom'];
	$telephone = $choriste['Telephone'];
	$email = $choriste['Email'];
	$type_choriste = $choriste['Type_choriste'];
	$is_admin = strtoupper($choriste['Is_admin']);



	// Pour le changement des donnees

	if (isset($_POST['envoyer'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$telephone = $_POST['phone'];
		$email = $_POST['email'];
		$type_choriste = $_POST['type_choriste'];
		$is_admin = $_POST['is_admin'];
		if ($is_admin=='oui') {
			$is_admin=true;
		} else {
			$is_admin=false;
		}
	
		$Updatereq="UPDATE `choriste` SET `Nom`='$nom',`Prenom`='$prenom',`Telephone`='$telephone',`Email`='$email',`Type_choriste`='$type_choriste',`Is_admin`='$is_admin' WHERE `Id_choriste`=" .$_GET['numChoriste']. "";
		$BaseDonnee->exec($Updatereq);

		header("location:choriste.php");
	}
	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	<title>Edition d'un choriste</title>
</head>
<body>
	<?php include('menu.php'); ?>

	<div class="container">
		<div class="panel panel-primary margintop">
			<div class="panel-heading">Edition d'un choriste</div>
			<div class="panel-body">
				<form method="post" action="" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nom">Nom :</label>
						<input type="text" name="nom" placeholder="Nom" autocomplete="off" class="form-control" value="<?php echo $nom ?>"/>
					</div>
					<div class="form-group">
						<label for="prenom">Prenom :</label>
						<input type="text" name="prenom" placeholder="Prenom" autocomplete="off" class="form-control" value="<?php echo $prenom ?>"/>
					</div>
					<div class="form-group">
						<label for="phone">Telephone :</label>
						<input type="text" name="phone" placeholder="Telephone" autocomplete="off" class="form-control" value="<?php echo $telephone ?>"/>
					</div>
					<div class="form-group">
						<label for="email">Email :</label>
						<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control" value="<?php echo $email ?>"/>
					</div>
					<div class="form-group">
						<label for="type_choriste">Type choriste :</label>
						<select name="type_choriste" class="form-control">
							<option value="Effectif" <?php if ($type_choriste=='Effectif') echo "selected" ?> selected/>Effectif</option>
							<option value="Candidat" <?php if ($type_choriste=='Candidat') echo "selected" ?> selected/>Candidat</option>
						</select>
					</div>
					<div class="form-group">
						<label for="is_admin">Is_admin :</label>
						<div class="radio">
							<label><input type="radio" name="is_admin" value="oui"
							<?php if ($is_admin=='oui') echo "checked" ?> checked/> oui</label>
							<label><input type="radio" name="is_admin" value="non"
							<?php if ($is_admin=='non') echo "checked" ?> checked/> non</label>
						</div>
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