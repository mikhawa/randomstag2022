<?php

// Manager
$stagiairesManager = new StagiairesManager($connect);
$statsManager = new AnneeManager($connect);


$idan = (int)$_GET['idan'];

$stats = $statsManager->SelectStatsByAnneeAndDate($idan,$tps);
// var_dump($_GET);
// si on a bien reçu le formulaire
if (isset($_GET['partie'])) {
    if ($_GET['partie'] == 'general'):
        $sortie = "<p>Nombre de questions : <strong>".$stats['sorties'] ."</strong></p>
                    <p>Nombre de très bonnes réponses :
                        <strong>".Calcul::Pourcent($stats["vgood"], $stats["sorties"])."</strong></p>
                    <p>Nombre de bonnes réponses :
                        <strong>".Calcul::Pourcent($stats["good"], $stats["sorties"])."</strong></p>
                    <p>Nombre de mauvaises réponses :
                        <strong>". Calcul::Pourcent($stats["nogood"], $stats["sorties"])."</strong></p>
                    <p>Nombre d'absences' :
                        <strong>". Calcul::Pourcent($stats["absent"], $stats["sorties"])."</strong></p>";

        echo $sortie;

    elseif ($_GET['partie'] == 'equipe'):
        $recupAllStagiaires = Calcul::calculPoints($stagiairesManager->SelectOnlyStagiairesByIdAnnee($idan,$tps));

        $i = 1;
        $sortie = "";
        foreach ($recupAllStagiaires as $item):

            $sortie .= "
        <tr>
            <th scope='row'>" . $i . "</th>
            <td>" . $item["prenom"] . " " . substr($item['nom'], 0, 1) . "</td>
            <td>" . $item["points"] . "</td>
            <td>" . Calcul::Pourcent($item["vgood"], $item["sorties"])
                . "</td>
            <td>" .
                Calcul::Pourcent($item["good"], $item["sorties"])
                . "</td>
            <td>" .
                Calcul::Pourcent($item["nogood"], $item["sorties"])
                . "</td>
            <td>" .
                Calcul::Pourcent($item["absent"], $item["sorties"])
                . "</td>
            <td>" . $item["sorties"] . "</td>
            <td>" . Calcul::Pourcent($item["sorties"], $stats['sorties']) . "</td>
        </tr>";

            $i++;
        endforeach;
        usleep(50000); // 0.05 seconde
        echo $sortie;

    elseif ($_GET['partie'] == 'hasard'):

        $recupOneStagiaire = $stagiairesManager->SelectOneRandomStagiairesByIdAnnee($idan);

        $sortie = "<div  class='modal-header'><h5 class='modal-title' id='staticBackdropLabel'>Question pour " . $recupOneStagiaire["prenom"] . " " . substr($recupOneStagiaire['nom'], 0, 1) . "</h5>
            <button type=\"button\" onclick=\"onLoadPage('hasard', 'hasard', new XMLHttpRequest());\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\">
            </div>
            <div id='idstagiaire' class='visually-hidden'>" . $recupOneStagiaire['idstagiaires'] . "</div>
                <div id='idannee' class='visually-hidden'>$idan</div>
            </div>
            ";
        echo $sortie;

    endif;

}