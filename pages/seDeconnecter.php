<?php
  session_start();
  unset($_SESSION['idChoriste']);
  unset($_SESSION['nom']);
  unset($_SESSION['prenom']);
  unset($_SESSION['phone']);
  unset($_SESSION['email']);
  unset($_SESSION['pass_word']);
  unset($_SESSION['type_choriste']);
  unset($_SESSION['is_admin']);

  header('location:login.php'); 
?>