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
	<title>Changer Mot de passe</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	<script src="../js/monjs.js"></script>
</head>
</head>
<body>

	<?php include("menu.php"); ?>

	<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 editpwd-page">
		<div class="panel panel-primary margintop">
			<div class="panel-heading">Changer votre Mot de passe</div>
			<div class="panel-body">
				<form method="post" action="updatePwd.php" class="form" enctype="multipart/form-data">

					<div class="form-group">
						<input minlength=4 type="password" id="inputM" name="oldpwd" placeholder="Tapez votre ancien mot de passe" autocomplete="false" class="form-control oldpwd" required />
						<i class="fa fa-eye show-old-pwd clickable" style="position: absolute; top: 124px; right: 37px; font-size: 18px;"></i>
					</div>
					<div class="form-group">
						<input type="password" name="newpassword" placeholder="Tapez votre nouveau mot de passe" autocomplete="false" class="form-control newpwd"/>
						<i class="fa fa-eye show-new-pwd clickable" style="position: absolute; top: 173px; right: 37px; font-size: 18px;"></i>
					</div>	

					<button type="submit" class="btn btn-success">
						<span class="glyphicon glyphicon-log-in"></span>
						Enregistrer
					</button>
					
				</form>
			</div>
			
		</div>
	</div>

</body>
</html>