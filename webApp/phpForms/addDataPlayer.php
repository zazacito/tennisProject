<?php
require("connectionDataBaseOracle.php");
global $dbConn;

if (isset($_POST)){

  $nomJoueur=$_POST['nomJoueur'];
  $prenonJoueur = $_POST['prenomJoueur'];
  $paysJoueur = $_POST['country'];
  $classJoueur = $_POST['classement'];




  $sql = 'INSERT INTO JOUEUR (JONAME,JOSURNAME,JOCLASS,JOCOUNTRY) '.
         'VALUES(:name, :surname, :class, :country)';

  $compiled = oci_parse($dbConn, $sql);

  oci_bind_by_name($compiled, ':name', $nomJoueur);
  oci_bind_by_name($compiled, ':surname', $prenonJoueur);
  oci_bind_by_name($compiled, ':class', $classJoueur);
  oci_bind_by_name($compiled, ':country', $paysJoueur);

  if ( !   oci_execute($compiled)){
    echo $dateDebut;
    $err = oci_error($compiled);
    trigger_error('Insertion failed: '. $err['message'], E_USER_ERROR);

  };



  header('Location: ../views/listPlayers.php');
  exit();
}
  ?>
