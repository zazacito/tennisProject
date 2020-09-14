<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Mon Tournoi</title>
</head>
<body style="background-color: #251E64!important; color:white">
    <header class="blog-header pt-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1 text-center">
          </div>
          <div class="col-4 text-center">
            <img src="logotennis.png" alt="" width="48" height="48">
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
          </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #251E64!important; color:white">

    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-white"  href=listTournament.php>Mes Tournois</a>
        </li>
        <li class="nav-item  ">
          <a class="nav-link text-white"  href=addTournament.php > Créer un Tournoi</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-white" href=listPlayers.php> Tous les Joueurs </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href=addPlayer.php> Ajouter un Joueur </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
      <br>
      <h3 class=ml-3><?php echo $_GET['tournoi']; ?>, <?php echo $_GET['lieu']; ?> </h3>
      <br>
      <br>
      <h4 class=ml-3>Tous les Matchs</h3>
      <br>
      <div class="col-md-10">
      <table class="table ml-4 mr-4" style="color:white">
        <thead class="" style="background-color: #633A6B!important; color:white">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Joueur 1</th>
            <th scope="col">Joueur 2</th>
            <th scope="col">Tour</th>
            <th scope="col">Date</th>
            <th scope="col">Arbitre</th>
            <th scope="col">Score</th>
            <th scope="col">Vainqueur</th>


          </tr>
        </thead>
        <tbody>
          <?php

          require("../phpForms/connectionDataBaseOracle.php");
          global $dbConn;

          $strSQL = "SELECT * FROM MATCH
                     WHERE TOID = ".$_GET['id'];

          $stmt = oci_parse($dbConn,$strSQL);

          $stid = oci_parse($dbConn,$strSQL);
          if ( ! oci_execute($stid) ){
            $err = oci_error($stid);
            trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
          };

          while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            $match = $row['MAID'];

            if ($row['MAWINNER'] == "Joueur 1"){
              $winner = $row['JOID'];
            }
            else{
              $winner = $row['JOU_JOID'];
            }

            $strSQL1 = "SELECT * FROM JOUEUR, MATCH
                       WHERE JOUEUR.JOID = MATCH.JOID
                       AND MATCH.MAID =".$match;

            $stmt1 = oci_parse($dbConn,$strSQL1);

            if ( ! oci_execute($stmt1) ){
            $err1 = oci_error($stmt1);
            trigger_error('Query failed: ' . $err1['message'], E_USER_ERROR);
            };


            $strSQL2 = "SELECT * FROM JOUEUR, MATCH
                       WHERE JOUEUR.JOID = MATCH.JOU_JOID
                       AND MATCH.MAID =".$match;

            $stmt2 = oci_parse($dbConn,$strSQL2);

            if ( ! oci_execute($stmt2) ){
            $err2 = oci_error($stmt2);
            trigger_error('Query failed: ' . $err2['message'], E_USER_ERROR);
            };

            $strSQL3 = "SELECT * FROM ARBITRE, MATCH
                       WHERE ARBITRE.ARID = MATCH.ARID
                       AND MATCH.MAID =".$match;

            $stmt3 = oci_parse($dbConn,$strSQL3);

            if ( ! oci_execute($stmt3) ){
            $err3 = oci_error($stmt3);
            trigger_error('Query failed: ' . $err3['message'], E_USER_ERROR);
            };

            $strSQL4 = "SELECT * FROM JOUEUR
                        WHERE JOUEUR.JOID =".$winner;

            $stmt4 = oci_parse($dbConn,$strSQL4);

            if ( ! oci_execute($stmt4) ){
            $err4 = oci_error($stmt4);
            trigger_error('Query failed: ' . $err4['message'], E_USER_ERROR);
            };

            while(oci_fetch($stmt1)){
            $name = oci_result($stmt1, 'JONAME');
            $surname = oci_result($stmt1, 'JOSURNAME');
            }
            while(oci_fetch($stmt2)){
            $name1 = oci_result($stmt2, 'JONAME');
            $surname1 = oci_result($stmt2, 'JOSURNAME');
            }
            while(oci_fetch($stmt3)){
            $name2 = oci_result($stmt3, 'ARNAME');
            $surname2 = oci_result($stmt3, 'ARSURNAME');
            }
            while(oci_fetch($stmt4)){
            $name3 = oci_result($stmt4, 'JONAME');
            $surname3 = oci_result($stmt4, 'JOSURNAME');
            }
             ?>
          <tr>
            <th scope="row"><?php echo $match ; ?></th>
            <td><?php echo $name." ".$surname ?></td>
            <td><?php echo $name1." ".$surname1 ?></td>
            <td><?php echo $row['MATOUR'] ; ?></td>
            <td><?php echo $row['MADATE'] ; ?></td>
            <td><?php echo $name2." ".$surname2 ?></td>
            <td><?php echo $row['MASCORE'] ; ?></td>
            <td><?php echo $name3." ".$surname3 ?></td>
          </tr>
        <?php }

        oci_free_statement($stid);
        ?>
        </tbody>
      </table>
    </div>
      <br>


        <button class="btn" type="submit" style="background-color: #633A6B!important; color:white"><a  href="addMatch.php?id=<?php echo $_GET['id'];?>&tournoi=<?php echo $_GET['tournoi'] ;?>&lieu=<?php echo $_GET['lieu'] ;?>"> Ajouter un Match </a></button>

      <br>
      <br>
      <hr>


    </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
