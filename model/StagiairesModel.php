<?php


class StagiairesModel extends AbstractModel
{
    protected int $idstagiaires;
    protected string $nom;
    protected string $prenom;
    protected int $annee_idannee;

    /**
     * @return int
     */
    public function getIdstagiaires(): int
    {
        return $this->idstagiaires;
    }

    /**
     * @param int $idstagiaires
     * @return StagiairesModel
     */
    public function setIdstagiaires(int $idstagiaires): StagiairesModel
    {
        $this->idstagiaires = $idstagiaires;
        return $this;
    }


    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return StagiairesModel
     */
    public function setNom(string $nom): StagiairesModel
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return StagiairesModel
     */
    public function setPrenom(string $prenom): StagiairesModel
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return int
     */
    public function getAnneeidannee(): int
    {
        return $this->annee_idannee;
    }

    /**
     * @param int $annee_idannee
     * @return StagiairesModel
     */
    public function setAnneeidannee(int $annee_idannee): StagiairesModel
    {
        $this->annee_idannee = $annee_idannee;
        return $this;
    }


}