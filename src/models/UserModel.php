<?php


class UserModel
{
    private $login;
    private $password;
    private $priviledge;
    private $email;
    private $userId;

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPriviledge()
    {
        return $this->priviledge;
    }

    public function setPriviledge($priviledge)
    {
        $this->priviledge = $priviledge;
    }

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}