<?php 
 session_start();
?>
<?php
	require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	$requete="select * from type_activite";
	
	$resultat=$BaseDonnee->query($requete); 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des choristes</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		<div class="panel panel-success margintop">
			<div class="panel-heading"> </div>
			<div class="panel-body">
						<a href="nouvelleActivite.php">
							<span class="glyphicon glyphicon-plus"></span>
							Nouvelle activite
						</a>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading"> Liste de type d'activites</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th> <th>Nom de type d'activite </th> <th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php while($type_activite=$resultat->fetch()){ ?>
								<tr>
									<td><?php echo $type_activite['Id_activite'] ?></td>
									<td><?php echo $type_activite['Nom_type_activite'] ?></td>
									<td>
										<a href="editerActivite.php? numActivite=<?php echo $type_activite['Id_activite']; ?>">
											<span class="glyphicon glyphicon-edit"></span>
										</a>
										&nbsp &nbsp;
										<a 	onclick="return confirm('Etes-vous sur de vouloir supprimmer une activite ?')" 
											href="supprimerAct.php?idTA=<?php echo $type_activite['Id_activite']?>">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>