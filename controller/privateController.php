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
    // année
    $recupStats = $statsManager->SelectAllByAnnee($logs);
    // logs et pagination
    $nblogs = $responseManager->countAllLogsByAnnee($logs);
    $pg = (isset($_GET['page'])&&ctype_digit($_GET['page']))? (int) $_GET['page'] : 1;
    $recupLogs = $responseManager->selectAllLogsByAnneeWithPG($logs,$pg);
    $pagination = ReponselogManager::pagination($nblogs,"?logs=$logs",$pg,"page",100);


    if(is_string($recupStats)) die($recupStats);
    if(is_string($recupLogs)) die($recupLogs);

    // View
    require_once "../view/logView.php";

// homepage admin
}else {

    $recupAllStagiaires = Calcul::calculPoints($stagiairesManager->SelectOnlyStagiairesByIdAnnee(1, $tps));

    $recupStats = $statsManager->SelectStatsByAnneeAndDate(1, $tps);

    $recupOneStagiaire = $stagiairesManager->SelectOneRandomStagiairesByIdAnnee(1);

    if(is_string($recupAllStagiaires)) die($recupAllStagiaires);
    if(is_string($recupStats)) die($recupStats);
    if(is_string($recupOneStagiaire)) die($recupOneStagiaire);

    // View
    require_once "../view/homepageView.php";
}
