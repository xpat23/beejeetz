<?php


namespace Model\Domain\Security;


class User
{
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;

    protected $username;

    protected $password;

    protected $role = self::ROLE_USER;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function isAdmin()
    {
        return $this->getRole() == self::ROLE_ADMIN;
    }

}