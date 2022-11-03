<?php

if(isset($_GET['disconnect'])){
    if(UserManager::disconnect()) header("Location: ./");
}

$stagiairesManager = new StagiairesManager($connect);
$statsManager = new AnneeManager($connect);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1,$tps);
$recupStats = $statsManager->SelectStatsByAnneeAndDate(1,$tps);

var_dump(Calcul::calculPoints($recupAllStagiaires),$recupAllStagiaires);


$recupOneStagiaire = $stagiairesManager->SelectOneRandomStagiairesByIdAnnee(1);

// var_dump($recupOneStagiaire);

// View
require_once "../view/homepageView.php";
