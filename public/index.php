<?php
session_start([
    'cookie_lifetime' => 86400,
]);

date_default_timezone_set('Europe/Brussels');

require_once "../config.php";

// Personal autoload
spl_autoload_register(function ($class) {
    include_once '../model/' . str_replace('\\', '/', $class) . '.php';
});

// connect with PDO
try {
    $connect = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}

if (isset($_SESSION['myidsession']) && $_SESSION['myidsession'] == session_id()) {

    if (isset($_GET['temps'])) {
        switch ($_GET['temps']) {
            case "Tous":
                $tps = Calcul::laDate(CHOIX_DATE["tous"]);
                break;
            case "1-an":
                $tps = Calcul::laDate(CHOIX_DATE["1 an"]);
                break;
            case "6-mois":
                $tps = Calcul::laDate(CHOIX_DATE["6 mois"]);
                break;
            case "3-mois":
                $tps = Calcul::laDate(CHOIX_DATE["3 mois"]);
                break;
            case "1-mois":
                $tps = Calcul::laDate(CHOIX_DATE["1 mois"]);
                break;
            case "2-semaines":
                $tps = Calcul::laDate(CHOIX_DATE["2 semaines"]);
                break;
            case "1-semaine":
                $tps = Calcul::laDate(CHOIX_DATE["1 semaine"]);
                break;
            default:
                $tps = Calcul::laDate(CHOIX_DATE["tous"]);
        }
    } else {
        $tps = Calcul::laDate(CHOIX_DATE["tous"]);
    }


    if (isset($_GET['myfile'])) {

        switch ($_GET['myfile']):
            case "update":
                require "../controller/update.php";
                break;
            case "load":
                require "../controller/load.php";
        endswitch;
    } else {
        require "../controller/privateController.php";
    }

} else {

    if (isset($_GET['myfile'])) {
        if (UserManager::disconnect()) header("Location: ./");
        exit();
    } else {
        require "../controller/publicController.php";
    }

}