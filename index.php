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
                    <a class="nav-link" href="club.php">Club</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



<!-- Clasement Première League -->

<body>
    <div class="container">

        <?php
        // Créer une instance de la classe API
        $api = new FootballData();
        echo "<p><hr><p>";  ?>


        <h3 style="font-weight: bold;"><img class="logoBPL" src="Img/BPL.png" alt="BPL" width="120"> Premiere League : Classement (Angleterre) - Saison 2020/2021</h3>

        <table class="table table-primary table-striped table-hover table table-bordered">
            <tr>
                <th>Position</th>
                <th>Club</th>
                <th>MJ</th>
                <th>G</th>
                <th>N</th>
                <th>P</th>
                <th>BP</th>
                <th>BC</th>
                <th>DB</th>
                <th>Pts</th>
            </tr>
            <?php foreach ($api->findStandingsByCompetition(2021)->standings as $standing) {
                if ($standing->type == 'TOTAL') {
                    foreach ($standing->table as $standingRow) {
            ?>
                        <tr>
                            <td <?php if ($standingRow->position == 1 || $standingRow->position == 2 || $standingRow->position == 3 || $standingRow->position == 4) {  ?> style="color: green; font-weight: bold; border-color: rgb(85,107,47);" <?php } else if ($standingRow->position == 18 || $standingRow->position == 19 || $standingRow->position == 20) {  ?> style="color: red; font-weight: bold; border-color: red;" <?php } ?>><?php echo $standingRow->position; ?></td>
                            <td><?php echo $standingRow->team->name; ?></td>
                            <td><?php echo $standingRow->playedGames; ?></td>
                            <td><?php echo $standingRow->won; ?></td>
                            <td><?php echo $standingRow->draw; ?></td>
                            <td><?php echo $standingRow->lost; ?></td>
                            <td><?php echo $standingRow->goalsFor; ?></td>
                            <td><?php echo $standingRow->goalsAgainst; ?></td>
                            <td><?php echo $standingRow->goalDifference; ?></td>
                            <td><?php echo $standingRow->points; ?></td>
                        </tr>
            <?php }
                }
            } ?>
            <tr>
            </tr>
        </table>

        <!-- Règles competions européennes et relégations -->

        <div id="carreVert">
        </div>
        <div class=" LDC">
            <p> UEFA Champions League</p>

        </div>

        <div id="carreRouge">
        </div>

        <div class=" Relegation">
            <p> Relegation</p>
        </div>

        <!-- Match 29ème journée -->

        <?php
        echo "<p><hr><p>"; ?>

        <h3 style="font-weight: bold;"><img class="logoBallon" src="Img/ballon.png" alt="BPL" width="120"> Matchs de la 29ème journée : Premiere League</h3>
        <table class="table table-primary table-striped table-hover table table-bordered">
            <tr>
                <th>Equipe Domicile</th>
                <th></th>
                <th>Equipe Visiteuse</th>
                <th colspan="3">Resultat</th>
            </tr>
            <?php foreach ($api->findMatchesByCompetitionAndMatchday(2021, 29)->matches as $match) { ?>
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