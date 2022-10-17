<?php


class UsereModel extends AbstractModel
{
    protected int $iduser;
    protected string $username;
    protected string $userpwd;
    protected string $themail;
    protected string $clefunique;

    /**
     * @return int
     */
    public function getIduser(): int
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     * @return UsereModel
     */
    public function setIduser(int $iduser): UsereModel
    {
        $this->iduser = $iduser;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return UsereModel
     */
    public function setUsername(string $username): UsereModel
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserpwd(): string
    {
        return $this->userpwd;
    }

    /**
     * @param string $userpwd
     * @return UsereModel
     */
    public function setUserpwd(string $userpwd): UsereModel
    {
        $this->userpwd = $userpwd;
        return $this;
    }

    /**
     * @return string
     */
    public function getThemail(): string
    {
        return $this->themail;
    }

    /**
     * @param string $themail
     * @return UsereModel
     */
    public function setThemail(string $themail): UsereModel
    {
        $this->themail = $themail;
        return $this;
    }

    /**
     * @return string
     */
    public function getClefunique(): string
    {
        return $this->clefunique;
    }

    /**
     * @param string $clefunique
     * @return UsereModel
     */
    public function setClefunique(string $clefunique): UsereModel
    {
        $this->clefunique = $clefunique;
        return $this;
    }



}