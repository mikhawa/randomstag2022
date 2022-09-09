<?php

$stagiairesManager = new StagiairesManager($idannee);

$recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee(1);

