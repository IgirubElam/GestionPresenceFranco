<?php
	require_once('connexionbd.php');
	$nom = isset($_POST['nom'])?$_POST['nom']:""; 
	$prenom = isset($_POST['prenom'])?$_POST['prenom']:"";
	$telephone = isset($_POST['phone'])?$_POST['phone']:"";
	$email = isset($_POST['email'])?$_POST['email']:"";
	$password = isset($_POST['password'])?$_POST['password']:"";
	$type_choriste = isset($_POST['type_choriste'])?$_POST['type_choriste']:"";
	$is_admin = isset($_POST['is_admin'])?$_POST['is_admin']:"";
	if ($is_admin=='oui') {
		$is_admin=true;
	} else {
		$is_admin=false;
	}
	
		$requete = "INSERT INTO `choriste`(`Nom`, `Prenom`, `Telephone`, `Email`, `Password`, `Type_choriste`, `Is_admin`) VALUES (?,?,?,?,?,?,?)";
		$parametres = array($nom,$prenom,$telephone,$email,$password,$type_choriste,$is_admin);
		$resultat=$BaseDonnee->prepare($requete);
		$resultat->execute($parametres);

	

	header('location:choriste.php');
 ?>