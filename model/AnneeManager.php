<?php


class AnneeManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectStatsByAnneeAndDate(int $idannee, int $date = 1000): array|string
    {
        $sql = "SELECT a.*, (SELECT COUNT(r.idreponseslog)  FROM reponseslog r WHERE r.annee_idannee = :annee AND  r.reponseslogcol = 3) AS vgood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogcol = 2) AS good,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogcol = 1) AS nogood,
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee AND r.reponseslogcol = 0) AS absent,  
                (SELECT COUNT(r.idreponseslog) FROM reponseslog r WHERE r.annee_idannee = :annee) AS sorties
                                        
                FROM annee a
                WHERE a.idannee  = :annee

                    ;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute(['annee'=>$idannee]);
            return $prepare->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }

}