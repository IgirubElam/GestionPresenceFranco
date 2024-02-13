<?php
	session_start();
	 require_once('connexionbd.php');

	 if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}
	require('fonction.php');

	$nameR = isset($_GET['nameR'])?$_GET['nameR']:"";

	$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : "";
	$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : "";

	$sql = "select distinct Id_activite,Nom_type_activite  from type_activite,appel where type_activite.Id_activite =appel.Id_type_activite";
	$resultat = $BaseDonnee->query($sql);

	$requete = "SELECT * FROM absence, appel, type_activite, choriste 
            WHERE absence.Id_appel = appel.Id_appel 
            AND appel.Id_type_activite = type_activite.Id_activite 
            AND absence.Id_choriste = choriste.Id_choriste";

   if (!empty($start_date) && !empty($end_date)) {
	    $start_date = date('Y-m-d', strtotime($start_date));
	    $end_date = date('Y-m-d', strtotime($end_date));
	    $requete .= " AND appel.Date BETWEEN '$start_date' AND '$end_date'";
	}

	if (!empty($nameR)) {
	    $requete .= " AND choriste.Nom LIKE '%$nameR%'";
	}

	$resultat_absences=$BaseDonnee->query($requete);

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
		
		<div class="panel panel-success margintop">
			<div class="panel-heading"> Liste des absences</div>
			<div class="panel-body">
				<?php while($typeActivite = $resultat->fetch()){ ?>
				<button type="button" class="btn btn-primary btn_type_activite" id-type-activite="<?php echo $typeActivite['Id_activite'];?>"><?php echo $typeActivite['Nom_type_activite'] ?> </button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<?php } ?>
				
			</div>
		</div>

		<center>
		<form class="form-inline" method="GET">
		    <div class="form-group">
		        <label for="start_date">Date de début:</label>
		        <input type="date" name="start_date" class="form-control">
		    </div>
		    <div class="form-group">
		        <label for="end_date">Date de fin:</label>
		        <input type="date" name="end_date" class="form-control">
		    </div>
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

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Appel </th>
						<th>Nom </th> 
						<th>Prenom</th>
					</tr>
				</thead>

				<tbody>
					<tr>

						<?php while($r_absences=$resultat_absences->fetch()){ ?>
							<tr>
								<td>
									<center><?php echo $r_absences['Nom_type_activite'] ?></center>
									<center><?php echo "Appel du ".date("d/m/Y",strtotime($r_absences['Date'])) ?></center>
								</td>

								<td><?php echo $r_absences['Nom'] ?></td>
								<td><?php echo $r_absences['Prenom'] ?></td>
							</tr>
						<?php } ?>
					</tr>
				</tbody>
			</table>
			
		</div>

	</div>

	<script type="text/javascript">
		
		$(".btn_type_activite").click(function(e){

			var id_activite = $(this).attr("id-type-activite");

			$.ajax({
               
               url:'afficherAbsence.php',
               method:'post',
               data:{'id_activite':id_activite},
               dataType:"JSON",
               success:function(response){

               	var append="";
                if (response.length) {


                   $('.append_div').empty();

                    append +="<center><h2>"+response[0].nom_activite+"</h2></center>";
                	append +="<table class='table table-striped table-bordered'><thead><tr><th>Appel</th><th>Nom </th> <th>Prenom</th></tr></thead>";
                	append +="<tbody>";

                	for(emp in response){

                		append +="<tr>";
                		  append +="<td>"+response[emp].date_appel+"</td>";
                		  append +="<td>"+response[emp].nom_choriste+"</td>";
                		  append +="<td>"+response[emp].prenom_choriste+"</td>";

                		append +="</tr>";
                	}

                	append +="</tbody>";
                	append +="</table>";

                } 

                $('.append_div').append(append);


               	
               }
			});

			
	   });


		
	</script>


	

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>