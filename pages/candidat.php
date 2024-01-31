
<?php
	session_start();
	 require_once('connexionbd.php');

	 if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}
	require('fonction.php');

	$requete="select * from choriste where Type_choriste = 'Candidat' ";
	
	$resultat=$BaseDonnee->query($requete);


	$requete1="select distinct Id_activite,Nom_type_activite  from type_activite,appel where type_activite.Id_activite =appel.Id_type_activite";
	
	$resultat1=$BaseDonnee->query($requete1);
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des choristes</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		
		<!-- <div class="panel panel-success margintop">
			<div class="panel-heading"> Liste des presences</div>
			<div class="panel-body">
			
				<?php while($type_act = $resultat1->fetch()){ ?>	
				<button type="button" class="btn btn-primary btn_type_activite" id-type-activite="<?php echo $type_act['Id_activite'];?>"><?php echo $type_act['Nom_type_activite'] ?></button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<?php } ?>
					
				
			</div>
		</div> -->

		<center>
		<form class="form-inline">
			<div class="form-group">
						<input type="text" name="nameR" placeholder="Le nom du choriste" autocomplete="off" class="form-control">
					</div>
							
			<button type="submit" class="btn btn-success"> 
				<span class="glyphicon glyphicon-search"></span> 
					Chercher...
			</button>
		</form>
		</center>
		&nbsp &nbsp;
		<div class="append_div">
			<h3> Pourcentage General: </h3>
			<div class="progress">
	  			<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
	  				aria-valuenow="<?php totalGeneralPresence()  ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php totalGeneralPresence()  ?>%">
	    			<?php totalGeneralPresence()  ?>%
	 			 </div>
			</div>

			<table class="table table-striped table-bordered">
						<thead>
							<center><h3>Pourcentage pour chaque choriste :</h3></center>
							<tr>
								<th>Nom </th> 
								<th>Prenom</th>
								<th>Pourcentage </th>
							</tr>
						</thead>

						<tbody id="response">
							<tr>
								<?php while($choriste=$resultat->fetch()){ ?>
									<tr>
										<td><?php echo $choriste['Nom'] ?></td>
										<td><?php echo $choriste['Prenom'] ?></td>
										<td><?php echo pourcentage_choriste($choriste['Id_choriste']) ?>%</td>
										<!-- <td><?php echo pourcentage_type_activite_choriste($choriste['Id_type_activite'],$choriste['Id_choriste']) ?>%</td> -->
										
								<?php } ?>
							</tr>
							
						</tbody>
			</table>

			<center><button type="button" class="btn btn-success btn-sm mb-2" onclick="window.print()"> <i class="fas fa-print"></i> Imprimer </button></center>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>