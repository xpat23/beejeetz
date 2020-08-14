<?php

namespace Model\Data\Security;

use Model\Domain\Security\User;
use Model\Domain\Security\UserRepositoryInterface;

class UserMockRepository implements UserRepositoryInterface
{

    public function findByUsername($username): ?User
    {
        $user = new User();
        $user->setUsername("admin");
        $user->setPassword("123");
        $user->setRole(User::ROLE_ADMIN);

        return  $user;
    }
}