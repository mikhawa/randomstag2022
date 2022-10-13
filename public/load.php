<?php
session_start();

require_once "../config.php";

// Personal autoload
spl_autoload_register(function ($class) {
    include_once '../model/' . str_replace('\\', '/', $class) . '.php';
});


// connect with PDO
try {
    $connect = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}

// Manager
$stagiairesManager = new StagiairesManager($connect);
$statsManager = new StatistiquesanneeManager($connect);


$idan = (int)$_GET['idan'];

$stats = $statsManager->SelectStatsByIdAnnee($idan);
// var_dump($_GET);
// si on a bien reçu le formulaire
if (isset($_GET['partie'])) {
    if ($_GET['partie'] == 'general'):
        $sortie = "<p>Nombre de questions : <strong>" . $stats['nbquestions'] . "</strong> </p>
    <p>Nombre de très bonnes réponses : <strong>" . Calcul::Pourcent($stats["nb3"], $stats["nbquestions"]) . "</strong> </p>
    <p>Nombre de bonnes réponses : <strong>" . Calcul::Pourcent($stats["nb2"], $stats["nbquestions"]) . "</strong> </p>
    <p>Nombre de mauvaises réponses : <strong>" . Calcul::Pourcent($stats["nb1"], $stats["nbquestions"]) . "</strong> </p>
    <p>Nombre d'absences' : <strong>" . Calcul::Pourcent($stats["nb0"], $stats["nbquestions"]) . "</strong> </p>";

        echo $sortie;

    elseif ($_GET['partie'] == 'graph'):
        $recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee($idan);
        $sortie = "";
        foreach ($recupAllStagiaires as $item):
            $dataPoints2[]=array("label"=> $item["prenom"] . " " . substr($item['nom'],0,1),
                "y" => (int) $item["points"],) ;
            
        endforeach;
        $sortie .= "<script>
                        function deux() {
                            var chart2 = new CanvasJS.Chart('chartContainer2', {
                                animationEnabled: true,
                                theme: 'light2', // 'light1', 'light2', 'dark1', 'dark2'
                                title: {
                                    text: 'Top des Stagiaires'
                                },
                                axisY: {
                                    title: 'Points'
                                },
                                data: [{
                                    type: 'column',
                                    dataPoints: ". json_encode($dataPoints2, JSON_NUMERIC_CHECK) ."
                                }]
                            });
                            // hey
                            chart2.render();
                        }
                        // test
                        deux();
                        // retest
                        
                    </script>";

        usleep(50000); // 0.05 seconde
        echo $sortie;

    elseif ($_GET['partie'] == 'equipe'):
        $recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee($idan);

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
            <td>" . Calcul::Pourcent($item["sorties"], $stats['nbquestions']) . "</td>
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