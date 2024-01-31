<?php
	session_start();
	 require_once('connexionbd.php');

	 if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	if (setlocale(LC_TIME, 'fr_FR') == '') {
		setlocale(LC_TIME, 'FRA');
		$format_jour = '%#d';
	}else{
		$format_jour = '%e';
	}

	 $id_user_authentifie=$_SESSION['idChoriste'];
	 $requete="select * from  absence,appel,type_activite where absence.Id_appel=appel.Id_appel AND appel.Id_type_activite =type_activite.Id_activite AND absence.Id_choriste='$id_user_authentifie' ";
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
		
		<div class="panel panel-primary margintop">
			<div class="panel-heading"> Mes absences</div>
			<div class="panel-body">

				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Activite </th> 
							<th>Date</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php while($mes_absences=$resultat->fetch()){ ?>
								<tr>
									<td><?php echo $mes_absences['Nom_type_activite'] ?></td>
									<td><?php echo strftime("%A $format_jour %B %Y",strtotime($mes_absences['Date'])) ?></td>
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