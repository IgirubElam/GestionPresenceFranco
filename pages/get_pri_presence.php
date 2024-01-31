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
	
	$requete_verify=$BaseDonnee->prepare("SELECT c.Nom, c.Prenom, a.Date
			FROM choriste c
			JOIN presence p ON c.Id_choriste = p.Id_choriste
			JOIN appel a ON p.Id_appel = a.Id_appel 
			WHERE a.Id_type_activite = 2");
	
	$requete_verify->execute(); 
	

	
		while ($pri_presence=$requete_verify->fetch()) {
			?>

			<tr>
				<td> <?php echo "Appel du ".strftime("%A $format_jour %B %Y",strtotime($pri_presence['Date'])) ?></td>
				<td> <?php echo $pri_presence['Nom'] ?></td>
				<td> <?php echo $pri_presence['Prenom'] ?></td>
			</tr>

	<?php		
		}
	


?>

 