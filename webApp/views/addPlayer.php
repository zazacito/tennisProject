<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Créer Un Projet</title>
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
        <li class="nav-item">
          <a class="nav-link text-white" href=listTournament.php>Mes Tournois</a>
        </li>
        <li class="nav-item  ">
          <a class="nav-link text-white"  href=addTournament.php  > Créer un Tournoi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href=listPlayers.php > Tous les Joueurs </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link text-white" href=addPlayer.php> Ajouter un Joueur </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container col-md-5">
    <br>
    <h1> Ajouter un Joueur </h1>
    <br>
    <form method="POST" action="../phpForms/addDataPlayer.php">
      <div class="form-group">
        <label for="nomJoueur">Nom</label>
        <input type="text" class="form-control" name="nomJoueur" placeholder="Nom du Joueur">
      </div>
      <div class="form-group">
        <label for="prenomJoueur">Pénom</label>
        <input type="text" class="form-control" name="prenomJoueur" placeholder="Pénom du Joueur">
      </div>
      <div class="form-group">
        <label for="country">Nationalité</label>
        <input type="text" class="form-control" name="country" placeholder="Nationalité du Joueur">
      </div>
      <div class="form-group">
        <label for="classement">Classement</label>
        <input type="number" class="form-control" name="classement" placeholder="Entrez le classement ATP du joueur"></input>
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
