<?php


class UserModel extends AbstractModel
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
     * @return UserModel
     */
    public function setIduser(int $iduser): UserModel
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
     * @return UserModel
     */
    public function setUsername(string $username): UserModel
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
     * @return UserModel
     */
    public function setUserpwd(string $userpwd): UserModel
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
     * @return UserModel
     */
    public function setThemail(string $themail): UserModel
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
     * @return UserModel
     */
    public function setClefunique(string $clefunique): UserModel
    {
        $this->clefunique = $clefunique;
        return $this;
    }


}