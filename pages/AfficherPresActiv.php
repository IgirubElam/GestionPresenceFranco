<?php
	require_once('connexionbd.php');
	require_once('fonction.php');
	$id_activite = isset($_POST['id_activite'])?$_POST['id_activite']:"";

	$response=array();
	
	//verifier si l'appel est deje fait

	//Pour presence
	$requete_verify=$BaseDonnee->prepare("select Nom,Prenom,appel.Date,Nom_type_activite,Id_type_activite,presence.Id_choriste from presence,appel,choriste,type_activite where presence.Id_appel=appel.Id_appel AND presence.Id_choriste=choriste.Id_choriste AND type_activite.Id_activite=appel.Id_type_activite AND appel.Id_type_activite='$id_activite' ");
	$requete_verify->execute(); 
	$la_presence=$requete_verify->fetchAll();
    
    $presence_list_array=array();
	foreach ($la_presence as $key => $value) {
		
		//$pourcentageG=pourcentageGeneralForActivite($value['Id_type_activite']);
		$pourcentage=pourcentage_type_activite_choriste($value['Id_type_activite'],$value['Id_choriste']);


		$presence_list_array[]=array(
			'nom_activite'=>$value['Nom_type_activite'],
			'nom_choriste'=>$value['Nom'],
			'prenom_choriste'=>$value['Prenom'],
			//'pourcentageG'=>$pourcentageG,
			'pourcentage'=>$pourcentage,
		);


	}



	$response=$presence_list_array;

	echo json_encode($response);
		
?>