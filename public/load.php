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


$idan = (int) $_GET['idan'];
// si on a bien reçu le formulaire
if(isset($_GET['partie'])){
    if($_GET['partie']=='general'):
        $stats = $statsManager->SelectStatsByIdAnnee($idan);

        $sortie="<p>Nombre de questions : <strong>".$stats['nbquestions']."</strong> </p>
    <p>Nombre de très bonnes réponses : <strong>".Calcul::Pourcent($stats["nb3"],$stats["nbquestions"])."</strong> </p>
    <p>Nombre de bonnes réponses : <strong>".Calcul::Pourcent($stats["nb2"],$stats["nbquestions"])."</strong> </p>
    <p>Nombre de mauvaises réponses : <strong>".Calcul::Pourcent($stats["nb1"],$stats["nbquestions"])."</strong> </p>
    <p>Nombre d'absences' : <strong>".Calcul::Pourcent($stats["nb0"],$stats["nbquestions"])."</strong> </p>";

        echo $sortie;

        elseif($_GET['partie']=='equipe'):
            echo "tasoeur";
    endif;

}