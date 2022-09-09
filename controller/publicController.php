<?php

$stagiairesManager = new StagiairesManager($idannee);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1);

// View
require_once "../view/homepage.php";
