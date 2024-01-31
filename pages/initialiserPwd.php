<?php
	 require_once('connexionbd.php');
	 require_once('../les_fonctions/fonctions.php');

	if (isset($_POST['email'])) {
		$email=$_POST['email'];
	}else{
		$email="";
	}



	$choriste= rechercher_choriste_par_email($email);

	if ($choriste != null) {
		$id=$choriste['Id_choriste'];
		$requete=$BaseDonnee->prepare("update choriste set Password=MD5('0000') where Id_choriste=$id");
		$requete->execute();

		$to=$choriste['Email'];
		$objet="Initialisation du mot de passe";
		$content="Votre nouveau mot de passe est 0000, veuillez le modifier à la prochaine ouverture de session";
		$entetes="From : App Franco". "\r\n" . "CC: codelam9@gmail.com";

		$sendM = mail($to,$objet,$content,$entetes);

		print(mail($to,$objet,$content,$entetes));

		$erreur="non";

		$msg="Un message contenant votre nouveau mot de passe a été envoyé sur votre adresse email.";


	} else{
		$erreur="oui";

		$msg="<strong>Erreur!</strong> L'email est incorrect";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Initialiser votre mot de passe</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container col-md-6 col-md-offset-3">
		<br>
		<div class="panel panel-primary">
			<div class="panel-heading">Initialiser le mot de passe</div>
			<div class="panel-body">
				<form method="post" class="form">
					<div class="form-group">
						<label class="control-label">
							Veuillez saisir votre email de récuperation
						</label>

						<input type="email" name="email" class="form-control">
					</div>

					<button type="submit" class="btn btn-success">Initialiser le mot de passe</button>
				</form>
			</div>
		</div>

		<div class="text-center">

			<?php 

			if ($erreur == "oui") {
				
				echo '<div class="alert alert-danger">' . $msg . '</div>';
				header("url=initialiserPwd.php");

				exit();

			} else if ($erreur == "non") {

				echo '<div class="alert alert-success">' . $msg . '</div>';
				header("url=login.php");

				exit();
			}

			?>
		
		</div>
	</div>
</body>
</html>