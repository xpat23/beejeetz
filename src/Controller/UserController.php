<?php

namespace Controller;

use Core\BaseController;
use Core\Request;
use Model\Domain\Security\SecurityService;

class UserController extends BaseController
{
    public function loginAction()
    {
        /** @var SecurityService $securityService */
        $securityService = $this->container->get(SecurityService::class);
        /** @var Request $request */
        $request = $this->container->get(Request::class);
        $error = null;

        if ($request->methodIs(Request::METHOD_POST)) {

            $username = $request->getRequest("username");
            $password = $request->getRequest("password");
            $user = $securityService->login($username, $password);

            if ($user) {
                $this->redirectToRoute("index");
            } else {
                $error = "Неправильный логин и(или) пароль";
            }
        }

        $this->renderView("user/login",[
            "error" => $error
        ]);
    }

    public function logoutAction()
    {
        /** @var SecurityService $securityService */
        $securityService = $this->container->get(SecurityService::class);
        $securityService->logout();
        $this->redirectToRoute("index");
    }

}