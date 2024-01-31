<?php
	require_once('connexionbd.php');

	$idTA = isset($_GET['idTA'])?$_GET['idTA']:0;

	$requete = "delete from type_activite where Id_activite=?";
	$param=array($idTA);
	$resultat=$BaseDonnee->prepare($requete);
	$resultat->execute($param);
	header('location:typeActivite.php');

?>