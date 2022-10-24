<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/logo.png"/>
    <title>Et la question est pour ... Connexion</title>
</head>
<body>

<div class="col-lg-11 mx-auto p-3 py-md-5">
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
            <img src="img/logo.png" width="45" height="40"/>
            <span class="fs-3 ps-2">Et la question est pour ... Connexion !</span>
        </a>
    </header>

    <main>
        <h1 class="h2">Groupe Webdev 2022-2023</h1>
        <p class="fs-5 col-md-8 mb-4">Une question, un.e stagiaire, une réponse !</p><hr>
        <form action="" name="login" method="post">
        <div class="d-grid gap-2 col-6 mx-auto">
            <div class="mb-3 mt-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Login</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="staticEmail" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" value="" name="userpwd" class="form-control" id="inputPassword" required>
                </div>
            </div>
            <div class="mb-1 row">
                <button type="submit" class="btn btn-primary mb-3">Connexion</button>
            </div>
        </div><?php
            if(isset($error)) echo $error
            ?>
        </form>
        <hr/>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>
</html>
