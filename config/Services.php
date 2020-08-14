<?php


namespace Config;


use Core\Connection;
use Model\Data\Security\UserMockRepository;
use Model\Data\Task\TaskRepository;
use Model\Domain\Security\SecurityService;
use Model\Domain\Security\UserRepositoryInterface;
use Model\Domain\Task\TaskRepositoryInterface;
use Model\Domain\Task\TaskValidator;

class Services extends \Core\Services
{
    public function getServices(): array
    {
        $services = parent::getServices();

        $services[TaskRepositoryInterface::class] = function () {
            return new TaskRepository($this->container->get(Connection::class));
        };

        $services[TaskValidator::class] = function () {
            return new TaskValidator();
        };
        $services[UserRepositoryInterface::class] = function () {
            return new UserMockRepository();
        };

        $services[SecurityService::class] = function () {
            return new SecurityService($this->container->get(UserRepositoryInterface::class));
        };

        return $services;
    }

}