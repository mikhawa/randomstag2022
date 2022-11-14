<?php


class ReponselogModel extends AbstractModel
{
    protected int $idreponseslog;
    protected int $reponseslogcol;
    protected string $remarque;
    protected string $reponseslogdate;
    protected int $user_iduser;
    protected int $stagiaires_idstagiaires;
    protected int $annee_idannee;

    /**
     * @return int
     */
    public function getIdreponseslog(): int
    {
        return $this->idreponseslog;
    }

    /**
     * @param int $idreponseslog
     * @return ReponselogModel
     */
    public function setIdreponseslog(int $idreponseslog): ReponselogModel
    {
        $this->idreponseslog = $idreponseslog;
        return $this;
    }

    /**
     * @return int
     */
    public function getReponseslogcol(): int
    {
        return $this->reponseslogcol;
    }

    /**
     * @param int $reponseslogcol
     * @return ReponselogModel
     */
    public function setReponseslogcol(int $reponseslogcol): ReponselogModel
    {
        $this->reponseslogcol = $reponseslogcol;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemarque(): string
    {
        return $this->remarque;
    }

    /**
     * @param string $remarque
     * @return ReponselogModel
     */
    public function setRemarque(string $remarque): ReponselogModel
    {
        $this->remarque = $remarque;
        return $this;
    }

    /**
     * @return string
     */
    public function getReponseslogdate(): string
    {
        return $this->reponseslogdate;
    }

    /**
     * @param string $reponseslogdate
     * @return ReponselogModel
     */
    public function setReponseslogdate(string $reponseslogdate): ReponselogModel
    {
        $this->reponseslogdate = $reponseslogdate;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserIduser(): int
    {
        return $this->user_iduser;
    }

    /**
     * @param int $user_iduser
     * @return ReponselogModel
     */
    public function setUserIduser(int $user_iduser): ReponselogModel
    {
        $this->user_iduser = $user_iduser;
        return $this;
    }

    /**
     * @return int
     */
    public function getStagiairesIdstagiaires(): int
    {
        return $this->stagiaires_idstagiaires;
    }

    /**
     * @param int $stagiaires_idstagiaires
     * @return ReponselogModel
     */
    public function setStagiairesIdstagiaires(int $stagiaires_idstagiaires): ReponselogModel
    {
        $this->stagiaires_idstagiaires = $stagiaires_idstagiaires;
        return $this;
    }

    /**
     * @return int
     */
    public function getAnneeIdannee(): int
    {
        return $this->annee_idannee;
    }

    /**
     * @param int $annee_idannee
     * @return ReponselogModel
     */
    public function setAnneeIdannee(int $annee_idannee): ReponselogModel
    {
        $this->annee_idannee = $annee_idannee;
        return $this;
    }




}