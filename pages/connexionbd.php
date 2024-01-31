<?php
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
?>