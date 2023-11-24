<?php

if(isset($_GET['disconnect'])){
    if(UserManager::disconnect()) header("Location: ./");
}



$stagiairesManager = new StagiairesManager($connect);
$statsManager = new AnneeManager($connect);

// tous les stagiaires de l'année:
$recupAll = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(2,$tps);

// par points
$recupAllStagiaires = Calcul::calculPoints($recupAll);

// par sorties
$sortiesStagiaires = Calcul::calculSorties($recupAll);

$recupStats = $statsManager->SelectStatsByAnneeAndDate(2,$tps);

if(is_string($recupAllStagiaires)) die($recupAllStagiaires);
if(is_string($recupStats)) die($recupStats);

// View
require_once "../view/stagView.php";
