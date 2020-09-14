<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Créer Un Tournoi</title>
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
          <a class="nav-link text-white" href=listTournament.php>Mes Tournois</a>
        </li>
        <li class="nav-item  ">
          <a class="nav-link text-white" href=addTournament.php > Créer un Tournoi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href=listPlayers.php > Tous les Joueurs </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-white" href=addPlayer.php> Ajouter un Joueur </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container col-md-5">
    <br>
    <h1 ><?php echo $_GET['tournoi']; ?>, <?php echo $_GET['lieu']; ?> </h1>
    <br>
    <br>
    <h2> Ajouter un Match</h2>
    <br>
    <form method="POST" action="../phpForms/addDataMatch.php?id=<?php echo $_GET['id'];?>&tournoi=<?php echo $_GET['tournoi'] ;?>&lieu=<?php echo $_GET['lieu'] ;?>">
      <div class="form-group">
        <label for="playerOne">Joueur 1</label>
        <select class="form-control"  name="playerOne">
          <option value="" disabled selected>Choississez Joueur 1</option>
          <?php
          require("../phpForms/connectionDataBaseOracle.php");
          global $dbConn;


          $strSQL = "SELECT * FROM JOUEUR";

          $stmt = oci_parse($dbConn,$strSQL);

          $stid = oci_parse($dbConn,$strSQL);
          if ( ! oci_execute($stid) ){
            $err = oci_error($stid);
            trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
          };

          while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
             ?>


             <option value="<?php echo $row['JOID'] ; ?>"> <?php echo $row['JOSURNAME']." ".$row['JONAME'] ; ?></option>
           <?php  }

           oci_free_statement($stid);
           ?>
        </select>

      </div>
      <div class="form-group">
        <label for="playerTwo">Joueur 2</label>
        <select class="form-control"  name="playerTwo">
          <option value="" disabled selected>Choississez Joueur 2</option>
          <?php
          require("../phpForms/connectionDataBaseOracle.php");
          global $dbConn;


          $strSQL = "SELECT * FROM JOUEUR";

          $stmt = oci_parse($dbConn,$strSQL);

          $stid = oci_parse($dbConn,$strSQL);
          if ( ! oci_execute($stid) ){
            $err = oci_error($stid);
            trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
          };

          while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
             ?>


             <option value="<?php echo $row['JOID'] ; ?>"> <?php echo $row['JOSURNAME']." ".$row['JONAME'] ; ?></option>
           <?php  }

           oci_free_statement($stid);
           ?>
        </select>
      </div>
      <div class="form-group">
        <label for="referee">Arbitre</label>
        <select class="form-control"  name="referee">
          <option value="" disabled selected>Choississez Arbitre</option>
          <?php
          require("../phpForms/connectionDataBaseOracle.php");
          global $dbConn;


          $strSQL = "SELECT * FROM ARBITRE";

          $stmt = oci_parse($dbConn,$strSQL);

          $stid = oci_parse($dbConn,$strSQL);
          if ( ! oci_execute($stid) ){
            $err = oci_error($stid);
            trigger_error('Query failed: ' . $err['message'], E_USER_ERROR);
          };

          while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
             ?>


             <option value="<?php echo $row['ARID'] ; ?>"> <?php echo $row['ARSURNAME']." ".$row['ARNAME'] ; ?></option>
           <?php  }

           oci_free_statement($stid);
           ?>
        </select>
      </div>
      <div class="form-group">
        <label for="dateDebut">Date</label>
        <input type="date" class="form-control" name="dateDebut" placeholder="Date du Match">
      </div>
      <div class="form-group">
        <label for="tour">Tour</label>
        <select class="form-control"  name="tour">
          <option value="" disabled selected>Choississez le Tour du Match</option>
          <option value="1er Tour">1er Tour</option>
          <option value="2eme Tour">2ème Tour</option>
          <option value="3eme Tour">3ème Tour</option>
          <option value="Huitiemes">Huitièmes de Finale</option>
          <option value ="Quarts">Quart de Finale</otion>
          <option value="Demis">Demi Finale</option>
          <option value="Finale">Finale</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nombreJoueurs">Score</label>
        <input type="text" class="form-control" name="score" placeholder="Entrez le score"></input>
      </div>
      <div class="form-group">
        <label for="winner">Joueur Vainqueur</label>
        <select class="form-control" name="winner">
          <option value="" disabled selected>Choississez le joueur vainqueur du match</option>
          <option value="Joueur 1">1</option>
          <option value="Joueur 2">2</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-dark bg-success mb-2">Valider</button>
      </div>
    </form>


  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
