<?php 
 session_start();
?>
<?php
	require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	$requete="select * from appel,type_activite where appel.Id_type_activite=type_activite.Id_activite";
	$resultat=$BaseDonnee->query($requete);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des appels</title>
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
						<a href="nouveauAppel.php">
							<span class="glyphicon glyphicon-plus"></span>
							Creer appel
						</a>
			
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading"> Liste des appels</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th> <th>Type activite </th> <th>Date</th> <th>Statut</th> <th>Options</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php while($appel=$resultat->fetch()){ ?>
								<tr>
									<td><?php echo $appel['Id_appel'] ?></td>
									<td><?php echo $appel['Nom_type_activite'] ?></td>
									<td><?php echo $appel['Date'] ?></td>
									<td><?php
											$statut;
											$today_date = date("Y-m-d:i:s");
											$date_appel = $appel['Date'];

											if ($date_appel <= $today_date) {
												echo $statut = "Terminee";
											}
											else {
												echo $statut = "En cours...";
											}
										?>
									</td>
									<td>
										<a href="appel.php? numAppel=<?php echo $appel['Id_appel']; ?>">
											<?php
												if ($appel['Statut']==1) {
													echo '<button type="submit" class="btn btn-success" disabled>  
						 									Faire appel
															</button>';
												}else {
													echo '<button type="submit" class="btn btn-success">  
						 									Faire appel
															</button>';
												}
											?>
											
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