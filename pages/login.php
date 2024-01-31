<?php 
	session_start();
	if (isset($_SESSION['ErreurConnexion'])) 
		$erreurConnexion = $_SESSION['ErreurConnexion'];
	 	else {
	 		$erreurConnexion = "";
	 	}

	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page de connexion</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>

	<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
		<div class="panel panel-primary margintop">
			<div class="panel-heading">Login</div>
			<div class="panel-body">
				<form method="post" action="seConnecter.php" class="form" enctype="multipart/form-data">
					<?php if(!empty($erreurConnexion)) { ?>
						<div class="alert alert-danger">

							<?php echo $erreurConnexion ?>

						</div>
					<?php } ?>

					<div class="form-group">
						<label for="email">Email :</label>
						<input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="password">Mot de passe :</label>
						<input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control"/>
					</div>	

					<button type="submit" class="btn btn-success">
						<span class="glyphicon glyphicon-log-in"></span>
						Se connecter
					</button>

					<p class="text-right">
						<a href="initialiserPwd.php">Mot de passe oublié</a>
					</p>
					
				</form>
			</div>
			
		</div>
	</div>

</body>
</html>