<?php


namespace Model\Domain\Security;


interface UserRepositoryInterface
{
    public function findByUsername($username): ?User;
}