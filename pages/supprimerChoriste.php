<?php
	require_once('connexionbd.php');
	$idC = isset($_GET['idC'])?$_GET['idC']:0;

	$requete = "delete from choriste where Id_choriste=?";
	$param=array($idC);
	$resultat=$BaseDonnee->prepare($requete);
	$resultat->execute($param);
	header('location:choriste.php');

?>