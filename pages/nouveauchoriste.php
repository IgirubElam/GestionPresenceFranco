<?php 
 session_start();
?>
<?php
	require_once('connexionbd.php');

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajout du nouveau choriste</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		<div class="panel panel-primary margintop">
			<div class="panel-heading">Les informations du nouveau choriste :</div>
			<div class="panel-body">
				<form method="post" action="insertChoriste.php" class="form" enctype="multipart/form-data">
					<div class="form-group">
						<label for="nom">Nom :</label>
						<input type="text" name="nom" placeholder="Nom" autocomplete="off" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="prenom">Prenom :</label>
						<input type="text" name="prenom" placeholder="Prenom" autocomplete="off" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="phone">Telephone :</label>
						<input type="text" name="phone" placeholder="Telephone" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email :</label>
						<input type="email" name="email" placeholder="email" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password :</label>
						<input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control">
					</div>
					<div class="form-group">
						<label for="type_choriste">Type choriste :</label>
						<select name="type_choriste" class="form-control">
							<option value="Effectif">Effectif</option>
							<option value="Candidat">Candidat</option>
						</select>
						
					</div>
					
					<div class="form-group">
						<label for="is_admin">Is_admin :</label>
						<div class="radio">
							<label><input type="radio" name="is_admin" value="oui">Oui</label>
							<label><input type="radio" name="is_admin" value="non">Non</label>
						</div>
					</div>	

					<button type="submit" class="btn btn-success">
						<span class="glyphicon glyphicon-save"></span>
						Enregistrer
					</button>
					
				</form>
			</div>
			
		</div>
	</div>

</body>
</html>