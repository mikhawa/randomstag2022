<?php

class StatistiquesanneeModel extends AbstractModel
{
    protected int $idstatistiquesannee;
    protected int $nbquestions;
    protected int $nb0;
    protected int $nb1;
    protected int $nb2;
    protected int $nb3;
    protected int $annee_idannee;

    /**
     * @return int
     */
    public function getIdstatistiquesannee(): int
    {
        return $this->idstatistiquesannee;
    }

    /**
     * @param int $idstatistiquesannee
     * @return StatistiquesanneeModel
     */
    public function setIdstatistiquesannee(int $idstatistiquesannee): StatistiquesanneeModel
    {
        $this->idstatistiquesannee = $idstatistiquesannee;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbquestions(): int
    {
        return $this->nbquestions;
    }

    /**
     * @param int $nbquestions
     * @return StatistiquesanneeModel
     */
    public function setNbquestions(int $nbquestions): StatistiquesanneeModel
    {
        $this->nbquestions = $nbquestions;
        return $this;
    }

    /**
     * @return int
     */
    public function getNb0(): int
    {
        return $this->nb0;
    }

    /**
     * @param int $nb0
     * @return StatistiquesanneeModel
     */
    public function setNb0(int $nb0): StatistiquesanneeModel
    {
        $this->nb0 = $nb0;
        return $this;
    }

    /**
     * @return int
     */
    public function getNb1(): int
    {
        return $this->nb1;
    }

    /**
     * @param int $nb1
     * @return StatistiquesanneeModel
     */
    public function setNb1(int $nb1): StatistiquesanneeModel
    {
        $this->nb1 = $nb1;
        return $this;
    }

    /**
     * @return int
     */
    public function getNb2(): int
    {
        return $this->nb2;
    }

    /**
     * @param int $nb2
     * @return StatistiquesanneeModel
     */
    public function setNb2(int $nb2): StatistiquesanneeModel
    {
        $this->nb2 = $nb2;
        return $this;
    }

    /**
     * @return int
     */
    public function getNb3(): int
    {
        return $this->nb3;
    }

    /**
     * @param int $nb3
     * @return StatistiquesanneeModel
     */
    public function setNb3(int $nb3): StatistiquesanneeModel
    {
        $this->nb3 = $nb3;
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
     * @return StatistiquesanneeModel
     */
    public function setAnneeidannee(int $annee_idannee): StatistiquesanneeModel
    {
        $this->annee_idannee = $annee_idannee;
        return $this;
    }


}