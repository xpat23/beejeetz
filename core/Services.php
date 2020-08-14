<?php


namespace Core;


class Services
{
    /** @var ServiceContainer  */
    protected $container;

    public function __construct(ServiceContainer $container)
    {
        $this->container = $container;
    }

    public function getServices(): array
    {
        return [
            RouterInterface::class => function () {
                return new Router();
            },
            ViewInterface::class => function () {
                return new View();
            },
            Connection::class => function () {
                return new Connection();
            },
            Request::class => function() {
                return new Request();
            }
        ];
    }

}