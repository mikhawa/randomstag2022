<?php


class StagiairesManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectOnlyStagiairesByIdAnnee(int $idannee) : Array|String
    {
        $sql = "SELECT s.*,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 3) AS vgood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 2) AS good,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 1) AS nogood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 0) AS absent,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires) AS sorties
                    FROM stagiaires s
                    WHERE s.annee_idannee = ?
                    ORDER BY s.points DESC;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute([$idannee]);
            return $prepare->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    public function SelectOneRandomStagiairesByIdAnnee(int $idannee) : Array|String
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

    public function updatePointsStagiaireById(int $idstagiaire, string $newPoint)
    {

        // Début de transaction
        $this->connect->beginTransaction();

        try{

        // Sélection des points du stagiaire
        $sql = "SELECT points FROM stagiaires WHERE idstagiaires = ?";
        $prepare = $this->connect->prepare($sql);
        
        $prepare->execute([$idstagiaire]);
        $stagiaire = $prepare->fetch(\PDO::FETCH_ASSOC);
        $points = $stagiaire['points'];

        // gestion des points
        switch($newPoint):
            case "tbien":
                $points +=2;
            break;
            case "bien":
                $points ++;
            break;
            case "pbien":
            default:
                $points --;
        endswitch;
        
        // update des points du stagiaires
        $sql = "UPDATE stagiaires SET points = ? WHERE idstagiaires = ?";
        $prepare = $this->connect->prepare($sql);
        $prepare->execute([$points, $idstagiaire]);


        // insertion des logs
        

        $this->connect->commit();

        }catch(Exception $e){
            $this->connect->rollBack();
            return $e->getMessage();
        }
    }

}