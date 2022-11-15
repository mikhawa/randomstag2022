<?php

if(isset($_GET['disconnect'])){
    if(UserManager::disconnect()) header("Location: ./");
}

$stagiairesManager = new StagiairesManager($connect);
$statsManager = new AnneeManager($connect);
$responseManager = new ReponselogManager($connect);

// logs
if(isset($_GET['logs'])&&ctype_digit($_GET['logs'])){
    $logs = (int) $_GET['logs'];
    $recupStats = $statsManager->SelectAllByAnnee($logs);
    $recupLogs = $responseManager->selectAllLogsByAnnee($logs);

    if(is_string($recupStats)) die($recupStats);
    // View
    require_once "../view/logView.php";

// homepage admin
}else {

    $recupAllStagiaires = Calcul::calculPoints($stagiairesManager->SelectOnlyStagiairesByIdAnnee(1, $tps));

    $recupStats = $statsManager->SelectStatsByAnneeAndDate(1, $tps);

    $recupOneStagiaire = $stagiairesManager->SelectOneRandomStagiairesByIdAnnee(1);

    // View
    require_once "../view/homepageView.php";
}
