<?php
namespace Core;

class Application
{
    public function run()
    {

        $container = new ServiceContainer();

        $router = $container->get(RouterInterface::class);

        $controller = $router->getController();
        if ($controller and class_exists($controller)) {
            /** @var BaseController $controller */
            $controller = new $controller();
            if (!$controller instanceof BaseController)
                throw new \Exception("Controller must be Extends of '".BaseController::class."'");
            $controller->setContainer($container);
            $controller->setRouter($router);
            $action = $router->getAction()."Action";
            if (method_exists($controller,$action)) {
                $controller->$action($router->getId());
            }

        } else {
            echo "Page not found!";
        }
    }
}