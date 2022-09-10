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

<div class="col-lg-10 mx-auto p-3 py-md-5">
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
        <button type="button" class="btn btn-primary">Nouvelle question !</button>
    </div>
    <h2 class="h5">Statistiques Globales</h2>
    <p></p>
    <h2 class="h5">Statistiques Personnelles</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Prénom N.</th>
            <th scope="col">NB Question</th>
            <th scope="col">Réponse +=2</th>
            <th scope="col">Réponse ++</th>
            <th scope="col">Mauvaise --</th>
            <th scope="col">Absent --</th>
            <th scope="col">% sortie</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
    <pre><?php var_dump($recupAllStagiaires); ?></pre>

</main>
<footer class="pt-5 my-5 text-center text-muted border-top">
    Michaël Pitz - <a href="https://www.cf2m.be" target="_blank" title="Centre de formation CF2m">CF2m</a> &copy; <?=date("Y")?>
</footer>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</body>
</html>