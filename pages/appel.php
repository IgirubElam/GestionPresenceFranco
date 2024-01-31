<?php 
 session_start();
?>
<?php
	require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	$nameR = isset($_GET['nameR'])?$_GET['nameR']:"";
		
	$requete="select * from choriste where Nom like '%$nameR%' or Prenom like '%$nameR%'";
	
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
			<div class="panel-heading"> Recherche des choristes</div>
			<div class="panel-body">
				<form method="get" action="choriste.php" class="form-inline">
					<div class="form-group">
						<input type="text" name="nameR" placeholder="Le nom du choriste" autocomplete="off" class="form-control">
					</div>
						
						<button type="submit" class="btn btn-success"> 
							<span class="glyphicon glyphicon-search"></span> 
							 Chercher...
						</button>
				</form>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading"> Liste des choristes</div>
			<div class="panel-body">
				<input type="hidden" value="<?php echo $_GET['numAppel'] ?>" class="form-control" id="id_appel">

				<table class="table table-striped table-bordered">
					<thead>
						
							<th>ID</th> <th>Nom</th> <th>Prenom</th> <th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php
								 while($choriste=$resultat->fetch()){ ?>
									<tr>
										<td><?php echo $choriste['Id_choriste'] ?></td>
										<td><?php echo $choriste['Nom'] ?></td>
										<td><?php echo $choriste['Prenom'] ?></td>
										<td>
										
												<button type="submit" name="envoyer" data-id-choriste="<?php echo $choriste['Id_choriste']?>" class="id_du_choriste"><span class="glyphicon glyphicon-ok"></span></button>
										
												
											&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
										
												<button type="submit" name="envoyer" dataId-choriste="<?php echo $choriste['Id_choriste'] ?>" class="idChoriste"><span class="glyphicon glyphicon-remove"></span></button>
										
										</td>
									</tr>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

	</form>


	<script type="text/javascript">
		$(".id_du_choriste").click(function(e){

			e.preventDefault();

			var id_choriste=$(this).attr("data-id-choriste");
			var id_appel=$('#id_appel').val();

			$.ajax({
               
               url:'insertPresence.php',
               method:'post',
               data:{'id_choriste':id_choriste,'id_appel':id_appel},
               dataType:"JSON",
               success:function(response){

                  if (response.statut==1) {
                     
                    alert(response.message);
                    $(this).next('span').removeClass('glyphicon-ok');

                    $(this).next('span').addClass('glyphicon-ok-blue');
                  }
                  else{
                    
                    alert(response.message);
                    
                  }
               }
			});
		
 });
	</script>

	<script type="text/javascript">
		$(".idChoriste").click(function(e){

			e.preventDefault();

			var id_choriste=$(this).attr("dataId-choriste");
			var id_appel=$('#id_appel').val();

			$.ajax({
               
               url:'insertAbsence.php',
               method:'post',
               data:{'id_choriste':id_choriste,'id_appel':id_appel},
               dataType:"JSON",
               success:function(response){

                  if (response.statut==1) {
                     
                    alert(response.message);
                  }
                  else{
                    
                    alert(response.message);
                  }
               }
			});
		
 });
	</script>



	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>