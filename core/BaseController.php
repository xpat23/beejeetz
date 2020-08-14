<?php


namespace Core;


class BaseController
{
    /**
     * @var ServiceContainer
     */
    protected $container;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @param ServiceContainer $container
     */
    public function setContainer(ServiceContainer $container): void
    {
        $this->container = $container;
    }

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }

    public function redirectToRoute($routeName, array $args = [])
    {
        header('Location: ' . $this->router->generate($routeName,$args), true);
        exit();
    }

    protected function renderView(string $template,array $args) {
        /** @var ViewInterface $view */
        $view = $this->container->get(ViewInterface::class);
        $view->render($template,$args);
    }

}