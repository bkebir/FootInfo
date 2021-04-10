<?php
include 'mesFonctions.php';
?>
<!DOCTYPE html>
<html>
<!-- Liens -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>FootInfo</title>
  <link type="text/css" rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>



<!-- Navbar -->


<nav class="sticky-top navbar navbar-light navbar-expand-lg " style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">
      <img src="Img/logo.png" alt="Logo du site" width="170">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav col-md-auto mx-auto">
        <li class="nav-item me-4">
          <a class="nav-link" aria-current="page" href="index.html">Accueil</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="actualite.php">Actualite</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="championnat.html">Championnat</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="score.html">Score</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link active" href="club.php">Club</a>
        </li>
      </ul>
    </div>
  </div>
</nav>





<body>
  <div class="container">

    <?php
    // Créer une instance de la classe API
    $api = new FootballData();
    ?>


    <?php
    echo "<p><hr><p>";
    $matches = $api->findHomeMatchesByTeam(65);
    ?>
    <h3 style="font-weight: bold;"><img class=" logoCity" src="Img/ManCity.png" alt="BPL" width="120"> Matchs - Manchester City FC </h3>
    <table class="table table-primary table-striped table-hover table table-bordered">
      <tr>
        <th>Equipe Domicile</th>
        <th></th>
        <th>Equipe Visiteuse</th>
        <th colspan="3">Resultat</th>
      </tr>
      <?php foreach ($matches as $match) { ?>
        <tr>
          <td><?php echo $match->homeTeam->name; ?></td>
          <td>-</td>
          <td><?php echo $match->awayTeam->name; ?></td>
          <td><?php echo $match->score->fullTime->homeTeam;  ?></td>
          <td>:</td>
          <td><?php echo $match->score->fullTime->awayTeam;  ?></td>
        </tr>
      <?php } ?>
    </table>

    <?php
    echo "<p><hr><p>";
    // Afficher les joueurs d'une équipe spécifique
    $team = $api->findTeamById(65);
    ?>
    <h3 style="font-weight: bold;"><img class="maillot" src="Img/Manchester-City-2021-domicile-removebg-preview.png" alt="BPL" width="120"> Effectifs - <?php echo $team->name; ?></h3>
    <table class="table table-primary table-striped table-hover table table-bordered">
      <tr>
        <th>Nom</th>
        <th>Position</th>
        <th>Nationalité</th>
        <th>Date de naissance</th>
      </tr>
      <?php foreach ($team->squad as $player) { ?>
        <tr>
          <td><?php echo $player->name; ?></td>
          <td><?php echo $player->position; ?></td>
          <td><?php echo $player->nationality; ?></td>
          <td><?php echo $player->dateOfBirth; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>

  <!-- Footer -->
  <footer>

    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase titreFooter">Contact</h5>
          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!">Adresse</a>
              <p>156 rue de France,<br> 93100, Montreuil</p>
            </li>
            <li>
              <a href="#!">Email</a>
              <p>footinfo93@gmail.com</p>
            </li>
            <li>
              <a href="#!">Téléphone</a>
              <p>(+33)123456789</p>
            </li>
          </ul>
        </div>
        <div class="col-md-auto">
          <h5 class="text-uppercase titreFooter">À propos</h5>
          <ul class="list-unstyled mb-0">
            <li>
              <a href="#!">Condition d'utilisation</a>
            </li>
            <li>
              <a href="#!">Données personnelles</a>
            </li>
            <li>
              <a href="#!">Conditions de vente</a>
            </li>
            <li>
              <a href="#!">Mentions légales</a>
            </li>
          </ul>
        </div>
        <div class="col col-lg-4">
          <h5 class="text-uppercase titreFooter">Réseaux</h5>
          <ul class="list-unstyled mb-0">
            <li>
              <img class="footerImage" src="Img/twitter.jpg" alt="Twitter">
              <a href="https://twitter.com/FootInf38125259">Twitter</a>
            </li>
            <li>
              <img class="footerImage" src="Img/Youtube.png" alt="YouTube" style="margin-left: 10px;">
              <a href="https://www.youtube.com/channel/UCY5MPE7yKN8vQps415jLFAQ">YouTube</a>
            </li>

        </div>
      </div>


  </footer>

  <!-- Copyright -->

  <div class="copyright">
    <div class="contenu mx-auto">
      <h5 class="text-center">FootInfo © 2020 Copyright - Tous droits réservés</h5>
      <a href="index.php?module=acceuil"><img class="img-fluid" src="Img/logo.png" alt="Logo du Footer" /></a>
    </div>
  </div>
  </footer>


</body>

</html>