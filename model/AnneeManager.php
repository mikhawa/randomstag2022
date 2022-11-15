<?php


class AnneeManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectStatsByAnneeAndDate(int $idannee, string $temps): array|string
    {
        $sql = "SELECT a.*, (SELECT COUNT(r.idreponseslog)  FROM reponseslog r WHERE r.annee_idannee = :annee AND  r.reponseslogcol = 3 AND r.reponseslogdate > :temps) AS vgood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogcol = 2 AND r.reponseslogdate > :temps) AS good,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogcol = 1 AND r.reponseslogdate > :temps) AS nogood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogcol = 0 AND r.reponseslogdate > :temps) AS absent,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogdate > :temps) AS sorties
                                        
                FROM annee a
                WHERE a.idannee  = :annee

                    ;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute(
                [
                'annee'=>$idannee,
                'temps'=>$temps
                ]
            );
            return $prepare->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

    public function SelectAllByAnnee(int $idannee): array|string
    {
        $sql = "SELECT a.*
                FROM annee a
                WHERE a.idannee  = :annee

                    ;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute(
                [
                    'annee'=>$idannee,
                ]
            );
            if($prepare->rowCount()==0){
                throw new Exception("Année non existante");
            }
            return $prepare->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

}