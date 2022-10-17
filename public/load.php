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

    elseif ($_GET['partie'] == 'equipe'):
        $recupAllStagiaires = $stagiairesManager->SelectOnlyStagiairesByIdAnnee($idan);

        $i = 1;
        $sortie = "<tr>
        <td colspan='9'>
            <div id='chartdiv' style='height:400px;width:auto;'></div>";
        $sortie .= "
            <script>
                $(document).ready(function(){
                    $.jqplot.config.enablePlugins = true;";

                    $a = "[";
                    $b = "[";
                    foreach ($recupAllStagiaires as $item):
                        $a .= $item["points"].",";
                        $b .= "'".substr($item["prenom"],0,8) . "',";

                    endforeach;
                    $a.="]";$b.="]";
                    $sortie .= "
                    var s1 = {$a};
                    var ticks = {$b};
                        plot1 = $.jqplot('chartdiv', [s1], {
                        // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
                        animate: !$.jqplot.use_excanvas,
                        seriesDefaults:{
                            renderer:$.jqplot.BarRenderer,
                            rendererOptions: {
                                // Set the varyBarColor option to true to use different colors for each bar.
                                // The default series colors are used.
                                varyBarColor: true
                            },
                            pointLabels: { show: true }
                        },
                        axes: {
                            xaxis: {
                                renderer: $.jqplot.CategoryAxisRenderer,
                                ticks: ticks
                            }
                        },
                        highlighter: { show: false }
                    });

                });
            </script><hr>
        </td>
    </tr>";
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