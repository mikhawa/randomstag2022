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
                    FROM stagiaires s
                    LEFT JOIN reponseslog r
                        ON s.idstagiaires = r.stagiaires_idstagiaires
                    WHERE s.annee_idannee = ?
                    ORDER BY s.prenom ASC;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute([$idannee]);
            return $prepare->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}