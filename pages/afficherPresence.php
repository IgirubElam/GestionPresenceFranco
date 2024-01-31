<?php
	require_once('connexionbd.php');
	$id_activite = isset($_POST['id_activite'])?$_POST['id_activite']:"";

	$response=array();
	
	//verifier si l'appel est deje fait

	//Pour presence
	$requete_verify=$BaseDonnee->prepare("select Nom,Prenom,appel.Date,Nom_type_activite from presence,appel,choriste,type_activite where presence.Id_appel=appel.Id_appel AND presence.Id_choriste=choriste.Id_choriste AND type_activite.Id_activite=appel.Id_type_activite AND appel.Id_type_activite='$id_activite'  ");
	$requete_verify->execute(); 
	$la_presence=$requete_verify->fetchAll();
    
    $presence_list_array=array();
	foreach ($la_presence as $key => $value) {
		
		$date=date("d/m/Y",strtotime($value['Date']));

		$presence_list_array[]=array(
			'nom_activite'=>$value['Nom_type_activite'],
			'date_appel'=>"Appel du ".$date,
			'nom_choriste'=>$value['Nom'],
			'prenom_choriste'=>$value['Prenom'],
		);


	}



	$response=$presence_list_array;

	echo json_encode($response);

	

	

		
?>