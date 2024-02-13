<?php 
 session_start();
?>
<?php
	require_once("connexionbd.php");

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	$nameR = isset($_GET['nameR'])?$_GET['nameR']:"";
	$type = isset($_GET['type'])?$_GET['type']:"all";

	$size = isset($_GET['size'])?$_GET['size']:10;
	$page = isset($_GET['page'])?$_GET['page']:1;
	$offset = ($page-1)*$size;

	if ($type=="all") {
	    $requete = "SELECT * FROM choriste WHERE Nom LIKE '%$nameR%' OR Prenom LIKE '%$nameR%' LIMIT $size OFFSET $offset";
	    $requeteCount = "SELECT COUNT(*) countC FROM choriste WHERE Nom LIKE '%$nameR%' OR Prenom LIKE '%$nameR%'";
	} else {
	    $requete = "SELECT * FROM choriste WHERE (Nom LIKE '%$nameR%' OR Prenom LIKE '%$nameR%') AND Type_choriste = '$type' LIMIT $size OFFSET $offset";
	    $requeteCount = "SELECT COUNT(*) countC FROM choriste WHERE (Nom LIKE '%$nameR%' OR Prenom LIKE '%$nameR%') AND Type_choriste = '$type'";
	}
		
	$resultat=$BaseDonnee->query($requete); 
	$resultatCount = $BaseDonnee->query($requeteCount);
	$tabCount = $resultatCount->fetch();

	$nbrChoriste = $tabCount['countC'];
	$reste = $nbrChoriste % $size;

	if ($reste === 0) {
		$nbrPage = $nbrChoriste/$size;
	}else {
		$nbrPage = floor($nbrChoriste/$size)+1;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des choristes</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		<div class="panel panel-success margintop">
			<div class="panel-heading"> Recherche des choristes</div>
			<div class="panel-body">
				

				<form method="get" action="choriste.php" class="form-inline">
		            <div class="form-group">
		                <input type="text" name="nameR" placeholder="Le nom du choriste" autocomplete="off" class="form-control">
		            </div>
		            <div class="form-group">
		                <label for="type">Type choriste:</label>
		                <select name="type" class="form-control" id="type">
		                    <option value="all" <?php if($type==="all") echo "selected" ?>>Tous les choristes</option>
		                    <option value="Effectif" <?php if($type==="Effectif") echo "selected" ?>>Effectif</option>
		                    <option value="Candidat" <?php if($type==="Candidat") echo "selected" ?>>Candidat</option>
		                </select>
		            </div>
		            <button type="submit" class="btn btn-success"> 
		                <span class="glyphicon glyphicon-search"></span> 
		                 Chercher...
		            </button>
		            &nbsp;&nbsp;
		            <a href="nouveauchoriste.php">
		                <span class="glyphicon glyphicon-plus"></span>
		                Nouveau(ou elle) choriste
		            </a>
		        </form>

			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading"> Liste des choristes</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th> <th>Nom </th> <th>Prenom</th> <th>Email</th> <th>Type choriste</th> <th>Is admin</th> <th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<?php while($choriste=$resultat->fetch()){ ?>
								<tr>
									<td><?php echo $choriste['Id_choriste'] ?></td>
									<td><?php echo $choriste['Nom'] ?></td>
									<td><?php echo $choriste['Prenom'] ?></td>
									<td><?php echo $choriste['Email'] ?></td>
									<td><?php echo $choriste['Type_choriste'] ?></td>
									<td><?php echo $choriste['Is_admin'] ?></td>
									<td>
										<a href="editerChoriste.php? numChoriste=<?php echo $choriste['Id_choriste']; ?>">
											<span class="glyphicon glyphicon-edit"></span>
										</a>
										&nbsp &nbsp;
										<a 	onclick="return confirm('Etes-vous sur de vouloir supprimer cet choriste ?')" 
											href="supprimerChoriste.php?idC=<?php echo $choriste['Id_choriste']?>">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>

				<ul class="pagination">
				    <?php 
				    for ($i = 1; $i <= $nbrPage; $i++) {
				        // Ajoutez les paramètres de recherche et de type aux liens de pagination
				        $paginationLink = "choriste.php?page=$i&nameR=$nameR&type=$type";
				    ?>
				        <li class="<?php if ($i == $page) echo 'active' ?>">
				            <a href="<?php echo $paginationLink; ?>">
				                <?php echo $i; ?>
				            </a>
				        </li>
				    <?php } ?>
				</ul>
		</div>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>