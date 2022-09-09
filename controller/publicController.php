<?php

$stagiairesManager = new StagiairesManager($idannee);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1);

require_once "../view/homepage.php";