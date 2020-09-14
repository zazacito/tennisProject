<?php

require("connectionDataBaseOracle.php");

global $dbConn;

if (isset($_POST)){

  $email=$_POST['inputEmail'];
  $password = $_POST['inputPassword'];

  echo $email;

  $strSQL = 'SELECT * FROM UTILISATEUR
              WHERE UTILISATEUR.USERID ='.$email ;

  $stmt = oci_parse($dbConn,$strSQL);


  if ( ! oci_execute($stmt) ){
  $err = oci_error($stmt);
  trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
  };

  while(oci_fetch($stmt)){
    $passwordCheck = oci_result($stmt, 'UMDP');
  }

  if ($password == $passwordCheck){
    session_start();

    $_SESSION['userId'] = $email;
    echo   $_SESSION['userId'];
    header('Location: ../views/listTournament.php');
    exit();
  }



}

 ?>
