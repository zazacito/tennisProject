<?php
require("connectionDataBaseOracle.php");
global $dbConn;

if (isset($_POST)){

  $joueur1= $_POST['playerOne'];
  $joueur2 = $_POST['playerTwo'];
  $referee = $_POST['referee'];
  $dateDebut =  date('d/m/y', strtotime($_POST['dateDebut']));
  $tour = $_POST['tour'];
  $score = $_POST['score'];
  $winner = $_POST['winner'];
  $idTournoi = $_GET['id'];
  $nameTournoi =$_GET['tournoi'];
  $place=$_GET['lieu'];



  $sql = 'INSERT INTO MATCH (TOID,MATOUR,JOID,JOU_JOID,ARID,MADATE,MASCORE,MAWINNER)'.
         "VALUES(:idTournoi,:maTour,:playerOne,:playerTwo,:referee,TO_DATE(:maDate,'dd/mm/yyyy'), :maScore,:maWinner )";

  $compiled = oci_parse($dbConn, $sql);

  oci_bind_by_name($compiled, ':idTournoi', $idTournoi);
  oci_bind_by_name($compiled, ':maTour', $tour);
  oci_bind_by_name($compiled, ':playerOne', $joueur1);
  oci_bind_by_name($compiled, ':playerTwo', $joueur2);
  oci_bind_by_name($compiled, ':referee', $referee);
  oci_bind_by_name($compiled, ':maDate', $dateDebut);
  oci_bind_by_name($compiled, ':maScore', $score);
  oci_bind_by_name($compiled, ':maWinner', $winner);




    if ( !   oci_execute($compiled)){
      echo $dateDebut;
      $err = oci_error($compiled);
      trigger_error('Insertion failed: '. $err['message'], E_USER_ERROR);

    };


  header('Location: ../views/myTournament.php?id='.$idTournoi."&tournoi=".$nameTournoi."&lieu=".$place);
  exit();
}
  ?>
