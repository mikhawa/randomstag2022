<?php


class StagiairesManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectOnlyStagiairesByIdAnnee(int $idannee, string $temps): array|string
    {
        $sql = "SELECT s.*,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 3 AND r.reponseslogdate > :temps) AS vgood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 2 AND r.reponseslogdate > :temps) AS good,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 1 AND r.reponseslogdate > :temps) AS nogood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogcol = 0 AND r.reponseslogdate > :temps) AS absent,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.stagiaires_idstagiaires = s.idstagiaires AND r.reponseslogdate > :temps) AS sorties 
                    FROM stagiaires s
                    WHERE s.annee_idannee = :annee
                    ;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute(
                [
                    'annee'=>$idannee,
                    'temps'=>$temps
                ]
            );

            if($prepare->rowCount()==0){
                throw new Exception("Pas de stagiaires de cette classe dans ce temps");
            }

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

            if($prepare->rowCount()==0){
                throw new Exception("Année non existante");
            }

            return $prepare->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    public function updatePointsStagiaireById(int $idstagiaire, int $newPoint, int $idannee, string|null $remarque)
    {


        try {

            // insertion des logs
            $sql = "INSERT INTO reponseslog (reponseslogcol,stagiaires_idstagiaires,user_iduser,annee_idannee,remarque) VALUES (?,?,?,?,?);";
            $prepare = $this->connect->prepare($sql);
            $prepare->execute([$newPoint, $idstagiaire,$_SESSION['iduser'],$idannee,$remarque]);


        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

}