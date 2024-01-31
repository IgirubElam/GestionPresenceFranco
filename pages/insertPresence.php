<?php
	require_once('connexionbd.php');
	$id_appel = isset($_POST['id_appel'])?$_POST['id_appel']:""; 
	$id_choriste = isset($_POST['id_choriste'])?$_POST['id_choriste']:"";

	$response=array();
	
	//verifier si l'appel est deje fait

	//Pour presence
	$requete_verify=$BaseDonnee->prepare("select * from presence where Id_choriste='$id_choriste' AND Id_appel='$id_appel' ");
	$requete_verify->execute(); 
	$la_presence=$requete_verify->fetchAll();

	//Pour absence
	$requete_verify=$BaseDonnee->prepare("select * from absence where Id_choriste='$id_choriste' AND Id_appel='$id_appel' ");
	$requete_verify->execute(); 
	$l_absence=$requete_verify->fetchAll();

	if (!$la_presence && !$l_absence) {
		
		$requete = "INSERT INTO `presence`(`Id_choriste`,`Id_appel`) VALUES (?,?)";
		$parametres = array($id_choriste,$id_appel);
		$resultat=$BaseDonnee->prepare($requete);
		//$resultat->execute($parametres);

		if ($resultat->execute($parametres)) {

			$response=array(
				'statut'=>1,
				'message'=>"Saved"
			);
		}
	}
	else{
       
        $response=array(
			'statut'=>0,
			'message'=>"Appel deja fait"
		);
	}

	

	echo json_encode($response);

		
?>