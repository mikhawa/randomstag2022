<?php
// start of session
session_start([
    // session.cookie_lifetime specifies the lifetime of the cookie in seconds
    'cookie_lifetime' => 86400,
]);

// sets the default timezone used by all date/time functions in a script
date_default_timezone_set('Europe/Brussels');

// load dependencies
require_once "../config.php";


// personal autoload to 'model' folder
spl_autoload_register(function ($class) {

    // include with namespace and name of class
    include_once '../model/' . str_replace('\\', '/', $class) . '.php';
});

// try to connect with PDO
try {

    // connect with PDO
    $connect = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD);

// exception handling
} catch (Exception $e) {

    // stop with message
    die($e->getMessage());

}

// if you are logged in validly
if (isset($_SESSION['myidsession']) && $_SESSION['myidsession'] == session_id()) {

    // management of the display time slot
    if (isset($_GET['temps'])) {
        switch ($_GET['temps']) {
            case "tous":
                // formats the date as datetime in the present and in the past
                $tps = Calcul::laDate(CHOIX_DATE["tous"]);
                $letps = "le début";
                break;
            case "1-an":
                $tps = Calcul::laDate(CHOIX_DATE["1 an"]);
                $letps = "1 an";
                break;
            case "6-mois":
                $tps = Calcul::laDate(CHOIX_DATE["6 mois"]);
                $letps = "6 mois";
                break;
            case "3-mois":
                $tps = Calcul::laDate(CHOIX_DATE["3 mois"]);
                $letps = "3 mois";
                break;
            case "1-mois":
                $tps = Calcul::laDate(CHOIX_DATE["1 mois"]);
                $letps = "1 mois";
                break;
            case "2-semaines":
                $tps = Calcul::laDate(CHOIX_DATE["2 semaines"]);
                $letps = "2 semaines";
                break;
            case "1-semaine":
                $tps = Calcul::laDate(CHOIX_DATE["1 semaine"]);
                $letps = "1 semaine";
                break;
            default:
                $tps = Calcul::laDate(CHOIX_DATE["tous"]);
                $letps = "le début";
        }
    } else {
        $tps = Calcul::laDate(CHOIX_DATE["tous"]);
        $letps = "le début";
    }

    // if we are a student
    if($_SESSION['perm']==0){

        // go to student controller
        require "../controller/stagController.php";

        // stop the script
        exit();
    }

    // if you are an administrator, manage ajax requests
    if (isset($_GET['myfile'])) {

        // ajax request
        switch ($_GET['myfile']):
            case "update":
                require "../controller/update.php";
                break;
            case "load":
                require "../controller/load.php";
        endswitch;
    } else {
        // go to admin controller
        require "../controller/privateController.php";
    }

// if you are not correctly connected
} else {

    // disconnect and redirect
    if (isset($_GET['myfile'])) {
        if (UserManager::disconnect()) header("Location: ./");
        exit();
    } else {

        // go to public controller
        require "../controller/publicController.php";
    }

}