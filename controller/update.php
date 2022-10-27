<?php


// Manager
$stagiairesManager = new StagiairesManager($connect);
$statsManager = new AnneeManager($connect);

// si on a bien reçu le formulaire
if (isset($_POST['idstag'])) {
    // récupération des données
    $idstag = (int)$_POST['idstag'];
    $idan = (int)$_POST['idan'];
    $points = $_POST['points'];
    // appel des statistiques globales
    $stats = $statsManager->SelectStatsByAnneeAndDate($idan,450);
    // appel de la mise à jour du stagiaire
    $update = $stagiairesManager->updatePointsStagiaireById($idstag, $points, $idan);
    echo $update;
    echo "Dernière mise à jour : " . date("Y-m-d H:i:s");
}