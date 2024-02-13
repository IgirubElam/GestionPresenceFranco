<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CHORALE FRANCOPHONE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">CHORALE FRANCOPHONE</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column flex-lg-row p-5">
        <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1 pe-3">
          <?php if($_SESSION['is_admin']==1){?>
							<li class="nav-item mx-2"><a class="nav-link" href="choriste.php">Choriste</a></li>
						    <?php }?>

						    <?php if($_SESSION['is_admin']==1){?>
							<li class="nav-item mx-2"><a class="nav-link" href="listeAppel.php">Liste des Appels</a></li>
							<?php }?>

							<?php if($_SESSION['is_admin']==1){?>
							<li class="nav-item mx-2"><a class="nav-link" href="typeActivite.php">Type activite</a></li>
							<?php }?>
							<li class="dropdown nav-item">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Presence</a>
								<ul class="dropdown-menu dropdown-menu-dark">

									<?php if($_SESSION['is_admin']==1){?>
									<li><a class="dropdown-item" href="listePresence.php">Listes des presences</a></li>
									<?php }?>

									<li><a class="dropdown-item" href="mesPresences.php">Mes presences</a></li>
								</ul>
							</li>
							<li class="dropdown nav-item">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Absence </a>
								<ul class="dropdown-menu dropdown-menu-dark">

									<?php if($_SESSION['is_admin']==1){?>
									<li><a class="dropdown-item" href="listeAbsence.php">Listes des absences</a></li>
									<?php }?>

									<li><a class="dropdown-item" href="mesAbsences.php">Mes absences</a></li>
								</ul>
							</li>

							<li class="nav-item mx-2"><a class="nav-link" href="statistique.php">Statistique</a></li>

	
						<div class="d-flex justify-content-center align-items-center gap-3">
							<li class="dropdown nav-item">
								<a class="nav-link dropdown-toggle text-white text-decoration-none bg-primary px-3 py-1 rounded-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-user"></i><?php echo ' '.$_SESSION['nom'].' '.$_SESSION['prenom']?></span></a>

								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="utilisateur.php"><i class="glyphicon glyphicon-log-in"></i> Mon compte</a></li>
									<li><a class="dropdown-item" href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i> Se deconnecter</a></li>
								</ul>	
							</li>
						</div>
      </div>
    </div>
  </div>
</nav>


</body>
</html>

