<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/logo.png"/>
    <title>Statistiques stagiaires | <?=$recupStats['section']?> <?=$recupStats['annee']?> depuis  <?=$letps?></title>
    <!-- Matomo -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="https://statistiques.cf2m.be/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '7']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light  justify-content-md-end" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="./">Tous</a></li>
        <li class="nav-item"><a class="nav-link" href="?temps=1-an">1 an</a></li>
        <li class="nav-item"><a class="nav-link" href="?temps=6-mois">6 mois</a></li>
        <li class="nav-item"><a class="nav-link" href="?temps=3-mois">3 mois</a></li>
        <li class="nav-item"><a class="nav-link" href="?temps=1-mois">1 mois</a></li>
        <li class="nav-item"><a class="nav-link" href="?temps=2-semaines">2 semaines</a></li>
        <li class="nav-item"><a class="nav-link" href="?temps=1-semaine">1 semaine</a></li>
    </ul>
    <a href="?disconnect"><button type="button" class="btn btn-primary">Déconnexion</button>
    </a>
        </div>
    </div>
</nav>
<div class="col-lg-11 mx-auto p-3 py-md-5">
    <header class="d-flex align-items-center pb-3 mb-2 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="img/logo.png" width="45" height="40"/>
            <span class="fs-3 ps-2">Statistiques stagiaires | <?=$recupStats['section']?> <?=$recupStats['annee']?> depuis <?=$letps?></span>
        </a>
    </header>

    <main>

<h2 class="h5">Statistiques Personnelles</h2>
<hr/>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">N°</th>
        <th scope="col">Prénom N.</th>
        <th scope="col">Points</th>
        <th scope="col">Réponses +=2</th>
        <th scope="col">Réponses ++</th>
        <th scope="col">Mauvaises --</th>
        <th scope="col">Absents --</th>
        <th scope="col">Total</th>
        <th scope="col">% sortie</th>
    </tr>
    </thead>
    <tbody id="updateAllStagiaires">
    <?php
    $i = 1;
    foreach ($recupAllStagiaires as $item):
        ?>
        <tr>
            <th scope="row"><?= $i ?></th>
            <td><?= $item["prenom"] . " " . substr($item['nom'], 0, 1) ?>.</td>
            <td><?= $item["points"] ?></td>
            <td><?php
                echo Calcul::Pourcent($item["vgood"], $item["sorties"]);
                ?></td>
            <td><?php
                echo Calcul::Pourcent($item["good"], $item["sorties"]);
                ?></td>
            <td><?php
                echo Calcul::Pourcent($item["nogood"], $item["sorties"]);
                ?></td>
            <td><?php
                echo Calcul::Pourcent($item["absent"], $item["sorties"]);
                ?></td>
            <td><?= $item["sorties"] ?></td>
            <td><?= Calcul::Pourcent($item["sorties"], $recupStats["sorties"]) ?></td>
        </tr>
        <?php
        $i++;
    endforeach;
    ?>
    </tbody>
</table>
<h2 class="h5">Statistiques Globales de <?=$recupStats['section']?> <?=$recupStats['annee']?>  depuis <?=$letps?></h2>
<hr/>
<div class="text-left">
    <div class="row">
        <div class="col" id="statstotal">
            <p>Nombre de questions : <strong><?= $recupStats['sorties'] ?></strong></p>
            <p>Nombre de très bonnes réponses :
                <strong><?= Calcul::Pourcent($recupStats["vgood"], $recupStats["sorties"]) ?></strong></p>
            <p>Nombre de bonnes réponses :
                <strong><?= Calcul::Pourcent($recupStats["good"], $recupStats["sorties"]) ?></strong></p>
            <p>Nombre de mauvaises réponses :
                <strong><?= Calcul::Pourcent($recupStats["nogood"], $recupStats["sorties"]) ?></strong></p>
            <p>Nombre d'absences' :
                <strong><?= Calcul::Pourcent($recupStats["absent"], $recupStats["sorties"]) ?></strong></p>
        </div>
        <div class="col p-2"></div>
    </div>
</div>
</main>
<footer class="pt-5 my-5 text-center text-muted border-top">
    Michaël Pitz - <a href="https://www.cf2m.be" target="_blank" title="Centre de formation CF2m">CF2m</a>
    - <a href="https://www.pixelandco.be/" target="_blank" title="Design et sites">Pixelandco</a> &copy; <?= date("Y") ?>
</footer>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>

</body>
</html>