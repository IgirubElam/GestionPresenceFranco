<?php
 session_start();

 require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des utilisateurs</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
		<div class="panel panel-primary margintop">
			<div class="panel-body">
				<?php
					$choristeId=$_SESSION['idChoriste'];
					$select="select * from choriste where Id_choriste='$choristeId'";
					$resultat=$BaseDonnee->query($select);
					$fetch=$resultat->fetch();
					if (empty($fetch['image'])) {
						echo '<center><img src="../images/default-avatar.png" class="img-circle" width="304" height="236"></center>';
					}else{
						echo '<img src="uploaded_img/'.$fetch['image'].'">';
					}
				?>
				<center><h3><?php echo ' '.$_SESSION['nom'].' '.$_SESSION['prenom']?></h3></center>
				<a href="#" class="btn btn-primary btn-sm btn-block">Update profile</a>
				<center><a href="changerMotPasse.php">Changer votre mot de passe</a></center>
				
			</div>
		</div>
		
	</div>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>