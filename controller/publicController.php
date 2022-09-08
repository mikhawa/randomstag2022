<?php

$stagiairesManager = new StagiairesManager($idannee);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1);

echo "<pre>";
var_dump($recupAllStagiaires);
echo "</pre>";