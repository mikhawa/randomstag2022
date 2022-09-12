<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/logo.png" />
    <title>Et la question est pour ...</title>
</head>
<body>

<div class="col-lg-11 mx-auto p-3 py-md-5">
<header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="img/logo.png" width="45" height="40"/>
        <span class="fs-3 ps-2">Et la question est pour ...</span>
    </a>
</header>

<main>
    <h1 class="h2">Groupe Webdev 2022-2023</h1>
    <p class="fs-5 col-md-8">Une question, un.e stagiaire, une réponse !</p>
    <div class="d-grid gap-2 col-6 mx-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Nouvelle question !</button>
    </div>
    <hr/>
    <h2 class="h5">Statistiques Globales</h2>
    <hr/>
    <div id="statstotal">
    <p>Nombre de questions : <strong><?=$recupStats['nbquestions']?></strong> </p>
    <p>Nombre de très bonnes réponses : <strong><?=Calcul::Pourcent($recupStats["nb3"],$recupStats["nbquestions"])?></strong> </p>
    <p>Nombre de bonnes réponses : <strong><?=Calcul::Pourcent($recupStats["nb2"],$recupStats["nbquestions"])?></strong> </p>
    <p>Nombre de mauvaises réponses : <strong><?=Calcul::Pourcent($recupStats["nb1"],$recupStats["nbquestions"])?></strong> </p>
    <p>Nombre d'absences' : <strong><?=Calcul::Pourcent($recupStats["nb0"],$recupStats["nbquestions"])?></strong> </p>
    </div>
    <hr/>
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
        <tbody>
        <?php
        $i=1;
        foreach($recupAllStagiaires as $item):
        ?>
        <tr>
            <th scope="row"><?=$i?></th>
            <td><?= $item["prenom"]." ".substr($item['nom'],0,1) ?></td>
            <td><?= $item["points"]?></td>
            <td><?php
                echo Calcul::Pourcent($item["vgood"],$item["sorties"]);
                ?></td>
            <td><?php
                echo Calcul::Pourcent($item["good"],$item["sorties"]);
                ?></td>
            <td><?php
                echo Calcul::Pourcent($item["nogood"],$item["sorties"]);
                ?></td>
            <td><?php
                echo Calcul::Pourcent($item["absent"],$item["sorties"]);
                ?></td>
            <td><?= $item["sorties"]?></td>
            <td><?= Calcul::Pourcent($item["sorties"],$recupStats['nbquestions'])?></td>
        </tr>
        <?php
        $i++;
        endforeach;
        ?>
        </tbody>
    </table>

</main>
<footer class="pt-5 my-5 text-center text-muted border-top">
    Michaël Pitz - <a href="https://www.cf2m.be" target="_blank" title="Centre de formation CF2m">CF2m</a> &copy; <?=date("Y")?>
</footer>
</div>

<!--
Modal
documentation:
https://getbootstrap.com/docs/5.2/components/modal/
-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Question pour</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Il suffit de répondre à la question
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Super réponse</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Bonne réponse</button>
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Et non...</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Absent.e</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</body>
</html>