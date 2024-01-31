<?php
	require_once('connexionbd.php');

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	} 

	

	function totalGeneralPresence(){

		$servername = "localhost";
    $username = "root";
    $password = "";

    try {
       $BaseDonnee = new PDO("mysql:host=$servername;dbname=franco", $username, $password);
      // set the PDO error mode to exception
       $BaseDonnee->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

		//recuperer le nombre total des presences
		$nb_tot_presence=$BaseDonnee->prepare("select count(*) as nb_tot_presence  from presence");
		$nb_tot_presence->execute();
		$nombre_total_presences=$nb_tot_presence->fetchColumn();
		
		//nombre total choristes
		$nb_tot_choristes=$BaseDonnee->prepare("select count(*) as nb_tot_choriste  from choriste");
		$nb_tot_choristes->execute();
		$nombre_total_choristes=$nb_tot_choristes->fetchColumn();

		//nombre total appels
		$nb_tot_appels=$BaseDonnee->prepare("select count(*) as nb_tot_appel  from appel");
		$nb_tot_appels->execute();
		$nombre_total_appels=$nb_tot_appels->fetchColumn();

		//calculer pourcentage
		$pourc=($nombre_total_presences*100)/($nombre_total_choristes*$nombre_total_appels);

		$pourcentage_formatte=round($pourc,2);


		echo $pourcentage_formatte;

		
	}

	function pourcentage_choriste($id_choriste){

		$servername = "localhost";
	  $username = "root";
	  $password = "";

	  try {
	     $BaseDonnee = new PDO("mysql:host=$servername;dbname=franco", $username, $password);
	    // set the PDO error mode to exception
	     $BaseDonnee->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully";
	  } catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	  }

		//recuperer le nombre total des presences
		$nb_tot_presence_choriste=$BaseDonnee->prepare("select count(*) as nb_tot_presence from presence where Id_choriste='$id_choriste' ");
		$nb_tot_presence_choriste->execute();
		$nombre_total_presences_choriste=$nb_tot_presence_choriste->fetchColumn();
		
		//nombre total presences du choriste
		$nb_tot_presences=$BaseDonnee->prepare("select count(*) as nb_tot_presence  from presence");
		$nb_tot_presences->execute();
		$nombre_total_presence=$nb_tot_presences->fetchColumn();

		//nombre total appels
		$nb_tot_appels=$BaseDonnee->prepare("select count(*) as nb_tot_appel  from appel");
		$nb_tot_appels->execute();
		$nombre_total_appels=$nb_tot_appels->fetchColumn();

		//calculer pourcentage
		$pourc=($nombre_total_presences_choriste*100)/($nombre_total_appels);

		$pourcentage_formatte=round($pourc,2);

		echo $pourcentage_formatte;



	}

	function pourcentage_type_activite_choriste($id_type_activite,$id_choriste){

		$servername = "localhost";
	  $username = "root";
	  $password = "";

	  try {
	     $BaseDonnee = new PDO("mysql:host=$servername;dbname=franco", $username, $password);
	    // set the PDO error mode to exception
	     $BaseDonnee->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully";
	  } catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	  }

		//recuperer le nombre total des presences
		$nb_tot_presence_choriste=$BaseDonnee->prepare("select count(*) as nb_tot_presence from presence,appel where presence.Id_appel=appel.Id_appel  AND  Id_type_activite='$id_type_activite' AND presence.Id_choriste='$id_choriste' AND appel.Statut='1' ");
		$nb_tot_presence_choriste->execute();
		$nombre_total_presences_choriste=$nb_tot_presence_choriste->fetchColumn();
		
		//nombre total presences du choriste
		$nb_tot_presences=$BaseDonnee->prepare("select count(*) as nb_tot_presence  from presence");
		$nb_tot_presences->execute();
		$nombre_total_presence=$nb_tot_presences->fetchColumn();

		//nombre total appels
		$nb_tot_appels=$BaseDonnee->prepare("select count(*) as nb_tot_appel  from appel");
		$nb_tot_appels->execute();
		$nombre_total_appels=$nb_tot_appels->fetchColumn();

		//calculer pourcentage
		$pourc=($nombre_total_presences_choriste*100)/($nombre_total_presence*$nombre_total_appels);

		$pourcentage_formatte=round($pourc,2);

		echo $pourcentage_formatte;



	}

	function pourcentageGeneralForActivite($id_type_activite){

		$servername = "localhost";
	  $username = "root";
	  $password = "";

	  try {
	     $BaseDonnee = new PDO("mysql:host=$servername;dbname=franco", $username, $password);
	    // set the PDO error mode to exception
	     $BaseDonnee->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully";
	  } catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	  }

		//recuperer le nombre total des presences
		$nb_tot_presence_choriste=$BaseDonnee->prepare("select count(*) as nb_tot_presence from presence,appel where presence.Id_appel=appel.Id_appel  AND  Id_type_activite='$id_type_activite' AND appel.Statut='1' ");
		$nb_tot_presence_choriste->execute();
		$nombre_total_presences_choriste=$nb_tot_presence_choriste->fetchColumn();
		
		//nombre total presences du choriste
		$nb_tot_presences=$BaseDonnee->prepare("select count(*) as nb_tot_choriste  from choriste");
		$nb_tot_presences->execute();
		$nombre_total_choriste=$nb_tot_presences->fetchColumn();

		//nombre total appels
		$nb_tot_appels=$BaseDonnee->prepare("select count(*) as nb_tot_appel  from appel,type_activite where appel.Id_type_activite=type_activite.Id_activite and Id_activite='$id_type_activite' ");
		$nb_tot_appels->execute();
		$nombre_total_appels=$nb_tot_appels->fetchColumn();

		//calculer pourcentage
		$pourc=($nombre_total_presences_choriste*100)/($nombre_total_appels);

		$pourcentage_formatte=round($pourc,2);

		echo $pourcentage_formatte;



	}



?>