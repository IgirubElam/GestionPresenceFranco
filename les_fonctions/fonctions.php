<?php
	
	function rechercher_par_nom($nom){
		global $BaseDonnee;
		$requete=$BaseDonnee->prepare("select * from choriste where Nom =?");
		$requete->execute(array($nom));
		return $requete->rowCount();
	} 

	function rechercher_par_email($email){
		global $BaseDonnee;
		$requete=$BaseDonnee->prepare("select * from choriste where Email =?");
		$requete->execute(array($email));
		return $requete->rowCount();
	}

	function rechercher_choriste_par_email($email){
		global $BaseDonnee;
		$requete=$BaseDonnee->prepare("select * from choriste where Email =?");
		$requete->execute(array($email));
		$cho=$requete->fetch();

		if ($cho) {
			return $cho;
		} else{
			return null;
		}
	}
?>