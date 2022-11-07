<?php

if(isset($_GET['disconnect'])){
    if(UserManager::disconnect()) header("Location: ./");
}

$stagiairesManager = new StagiairesManager($connect);
$statsManager = new AnneeManager($connect);

$recupAllStagiaires = Calcul::calculPoints($stagiairesManager->SelectOnlyStagiairesByIdAnnee(1,$tps));

$recupStats = $statsManager->SelectStatsByAnneeAndDate(1,$tps);



// View
require_once "../view/stagView.php";
