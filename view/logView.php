<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/logo.png"/>
    <title>Logs de <?=$recupStats['section']?> <?=$recupStats['annee']?></title>
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
        <li class="nav-item"><a class="nav-link" href="./">Retour à Tous</a></li>

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
            <span class="fs-3 ps-2">Logs de <?=$recupStats['section']?> <?=$recupStats['annee']?></span>
        </a>
    </header>

    <main>
        <div class="col-lg-11 mx-auto p-3 py-md-5">
            <h1 class="h2">Log de <?=$recupStats['section']?> <?=$recupStats['annee']?></h1>
            <p class=" h3 fs-5 pb-4 col-md-8">Une question, un.e stagiaire, une réponse !</p>
            <p><?php
            foreach($recupLogs as $item):

                echo "{$item['reponseslogdate']} | ID : {$item['idreponseslog']} | Points :";
                switch($item['reponseslogcol']):
                    case 3 :
                        echo " +2 ";
                        break;
                    case 2 :
                        echo " +1 ";
                        break;
                    case 1 :
                        echo " -1 (mauvaise réponse) ";
                        break;
                    case 0 :
                        echo " -1 (absence) ";
                        break;
                endswitch;
                echo "| Pour {$item['nom']} {$item['prenom']} | Par {$item['username']} | commentaire : {$item['remarque']}<br>";

            endforeach;

                ?></p>
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