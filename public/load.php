<?php
session_start();

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

// Manager
$stagiairesManager = new StagiairesManager($connect);
$statsManager = new StatistiquesanneeManager($connect);

// si on a bien reçu le formulaire
if(isset($_POST['idstag'])){
    // récupération des données
    $idstag = (int) $_POST['idstag'];
    $idan = (int) $_POST['idan'];
    $points = $_POST['points'];
    // appel des statistiques globales
    $stats = $statsManager->SelectStatsByIdAnnee($idan);
    // appel de la mise à jour du stagiaire
    $update = $stagiairesManager->updatePointsStagiaireById($idstag,$points,$stats);
    echo $update;

}