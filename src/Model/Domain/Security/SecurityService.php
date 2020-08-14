<?php

namespace Model\Domain\Security;

class SecurityService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login($username, $password): ?User
    {
        $user = $this->repository->findByUsername($username);
        if ($user and $user->getPassword() == $password) {
            $_SESSION['user'] = $user->getUsername();
            return $user;
        }

        return null;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function getCurrentUser(): ?User
    {
        if (isset($_SESSION['user'])) {
            return $this->repository->findByUsername($_SESSION['user']);
        }
        return null;
    }

}