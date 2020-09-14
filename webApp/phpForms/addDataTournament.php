<?php

require("connectionDataBaseOracle.php");

global $dbConn;
session_start();
if (isset($_POST)){

  $nomTournoi=$_POST['nomTournoi'];
  $lieuTournoi = $_POST['lieuTournoi'];
  $dateDebut =  date('d/m/y', strtotime($_POST['dateDebut']));
  $dateFin =  date('d/m/y', strtotime($_POST['dateFin']));
  $nombreJoueurs = $_POST['nombreJoueurs'];
  $regles = $_POST['regles'];




  $sql = "INSERT INTO TOURNOI (USERID,TONAME,TOPLACE,TOSTARTDATE,TOENDDATE,TONUMBER,TORULES)".
         "VALUES(:userId,:name,:location,TO_DATE(:startDate,'dd/mm/yyyy'),TO_DATE(:endDate,'dd/mm/yyyy'),:nombreJoueurs,:regles)";

  $compiled = oci_parse($dbConn, $sql);
  $userId = $_SESSION['userId'] ;
  oci_bind_by_name($compiled, ':userId', $userId);
  oci_bind_by_name($compiled, ':name', $nomTournoi);
  oci_bind_by_name($compiled, ':location', $lieuTournoi);
  oci_bind_by_name($compiled, ':startDate', $dateDebut);
  oci_bind_by_name($compiled, ':endDate', $dateFin);
  oci_bind_by_name($compiled, ':nombreJoueurs', $nombreJoueurs);
  oci_bind_by_name($compiled, ':regles', $regles);

  if ( !   oci_execute($compiled)){
    echo $dateDebut;
    $err = oci_error($compiled);
    trigger_error('Insertion failed: '. $err['message'], E_USER_ERROR);

  };



  header('Location: ../views/listTournament.php');
  exit();
}

 ?>
