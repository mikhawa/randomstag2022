<?php

$stagiairesManager = new StagiairesManager($connect);
$statsManager = new StatistiquesanneeManager($connect);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1);
$recupStats = $statsManager->SelectStatsByIdAnnee(1);

//var_dump($recupStats);

// View
require_once "../view/homepage.php";
