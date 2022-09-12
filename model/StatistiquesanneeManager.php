<?php


class StatistiquesanneeManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectStatsByIdAnnee(int $idannee) : Array|String
    {
        $sql = "SELECT * FROM statistiquesannee WHERE annee_idannee = ?";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute([$idannee]);
            return $prepare->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();

        }
    }
}