<?php


class StagiairesManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectOnlyStagiairesByIdAnnee(int $idannee): array|string
    {
        $sql = "SELECT s.*,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 3) AS vgood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 2) AS good,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 1) AS nogood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 0) AS absent,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires) AS sorties
                    FROM stagiaires s
                    WHERE s.annee_idannee = ?
                    ORDER BY s.points DESC
                    ;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute([$idannee]);
            return $prepare->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    public function SelectOneRandomStagiairesByIdAnnee(int $idannee): array|string
    {
        $sql = "SELECT s.*          
                    FROM stagiaires s
                    WHERE s.annee_idannee = ?
                    ORDER BY RAND()
                    LIMIT 1;
                ";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute([$idannee]);
            return $prepare->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    public function updatePointsStagiaireById(int $idstagiaire, string $newPoint, int $idannee)
    {

        // Début de transaction
        $this->connect->beginTransaction();

        try {

            // Sélection des points du stagiaire
            $sql = "SELECT points FROM stagiaires WHERE idstagiaires = ?";
            $prepare = $this->connect->prepare($sql);

            $prepare->execute([$idstagiaire]);
            $stagiaire = $prepare->fetch(\PDO::FETCH_ASSOC);
            $points = $stagiaire['points'];



            // gestion des points
            switch ($newPoint):
                case "tbien":
                    // points stagiaire
                    $points += 2;
                    // log stagiaire
                    $rep = 3;
                    break;
                case "bien":
                    $points++;
                    $rep = 2;
                    break;
                case "pbien":
                    $points--;
                    $rep = 1;
                    break;
                default:
                    $points--;
                    $rep = 0;
            endswitch;

            // update des points du stagiaire
            $sql = "UPDATE stagiaires SET points = ? WHERE idstagiaires = ?";
            $prepare = $this->connect->prepare($sql);
            $prepare->execute([$points, $idstagiaire]);


            // insertion des logs
            $sql = "INSERT INTO reponseslog (reponseslogcol,stagiaires_idstagiaires,user_iduser,annee_idannee) VALUES (?,?,?,?);";
            $prepare = $this->connect->prepare($sql);
            $prepare->execute([$rep, $idstagiaire,$_SESSION['iduser'],$idannee]);


            $this->connect->commit();

        } catch (Exception $e) {
            $this->connect->rollBack();
            return $e->getMessage();
        }
    }

}