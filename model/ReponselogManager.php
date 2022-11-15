<?php


class ReponselogManager implements ManagerInterface
{

    protected \PDO $connect;

    public function __construct(\PDO $db)
    {
        $this->connect = $db;
    }

    public function selectAllLogsByAnnee(int $annee): array|string{

        $prepare = $this->connect->prepare("
        SELECT r.idreponseslog, r.reponseslogcol, r.remarque, r.reponseslogdate, u.username, s.nom, s.prenom
        FROM reponseslog r 
        INNER JOIN user u 
            ON r.user_iduser = u.iduser
        INNER JOIN stagiaires s
            ON s.idstagiaires = r.stagiaires_idstagiaires
        WHERE r.annee_idannee = ?
        ORDER BY r.reponseslogdate DESC;
        ");

        try{
            $prepare->execute([$annee]);
            if($prepare->rowCount()==0){
                throw new Exception("Année non existante");
            }
            return $prepare->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $exception){
            return $exception->getMessage();
        }
    }

}