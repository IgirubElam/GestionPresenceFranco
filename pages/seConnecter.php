<?php
    session_start();
	require_once('connexionbd.php');
	$email = isset($_POST['email'])?$_POST['email']:"";
	$pwd = isset($_POST['password'])?$_POST['password']:"";

	$requete="select * from choriste where email='$email' and password = '$pwd'";
	$resultat=$BaseDonnee->query($requete);

	if ($var=$resultat->fetch()) {
		
		$_SESSION['idChoriste'] = $var['Id_choriste'];
		$_SESSION['nom'] = $var['Nom'];
		$_SESSION['prenom'] = $var['Prenom'];
		$_SESSION['phone'] = $var['Telephone']; 
		$_SESSION['email'] = $var['Email'];
		$_SESSION['pass_word'] = $var['Password'];
		$_SESSION['type_choriste'] = $var['Type_choriste'];
		$_SESSION['is_admin'] = $var['Is_admin'];
		$_SESSION['images'] = $var['image'];

		if ($var['Is_admin']==1) {
			// redirection a la page admin

			header('location:../index.php');
		}
		else{

           header('location:../index.php');
		}
	}
	else{

		$_SESSION['ErreurConnexion']="<strong>Erreur!!</strong>Email ou Mot de passe incorrecte";
		header('location:login.php');

	}

	$requeteA="select * from appel,type_activite,choriste where appel.Id_type_activite=type_activite.Id_activite and appel.Id_choriste=choriste.Id_choriste";
	$resultat=$BaseDonnee->query($requeteA);

	if ($appel=$resultat->fetch()) {
		
		$_SESSION['id_appel'] = $appel['Id_appel'];
		$_SESSION['id_type_activite'] = $appel['Id_type_activite'];
		$_SESSION['date'] = $appel['Date'];
		$_SESSION['statut'] = $appel['Statut'];
		$_SESSION['id_choriste'] = $appel['Id_choriste '];
		$_SESSION['nom_activite'] = $appel['Nom_type_activite'];

	}
	else{

	}
	
 ?>