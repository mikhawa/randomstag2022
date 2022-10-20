<?php

if(isset($_GET['disconnect'])){
    if(UserManager::disconnect()) header("Location: ./");
}

$stagiairesManager = new StagiairesManager($connect);
$statsManager = new StatistiquesanneeManager($connect);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1);
$recupStats = $statsManager->SelectStatsByIdAnnee(1);

$recupOneStagiaire = $stagiairesManager->SelectOneRandomStagiairesByIdAnnee(1);

// var_dump($recupOneStagiaire);

// View
require_once "../view/homepageView.php";
