<?php

namespace model;

class StagiairesManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function SelectOnlyStagiairesByAnnee(int $idannee) : Array|String
    {
        $sql = "SELECT * FROM stagiaires ORDER BY prenom ASC;";
        $prepare = $this->connect->prepare($sql);

        try {

            $prepare->execute([$idannee]);
            return $prepare->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}