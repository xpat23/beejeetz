<?php

namespace Config;
use Controller\TaskController;
use Controller\UserController;

class Routing
{
    public static function get()
    {
        return [
          "/" => [
              "controller" => TaskController::class,
              "name" => "index",
              "action" => "list"
          ],
            "/task/edit/{id}" => [
              "controller" => TaskController::class,
              "name" => "task_edit",
              "action" => "edit"
          ],
            "/task/new" => [
              "controller" => TaskController::class,
              "name" => "task_new",
              "action" => "new"
          ],
            "/user/login" => [
              "controller" => UserController::class,
              "name" => "user_login",
              "action" => "login"
          ]
            ,
            "/user/logout" => [
              "controller" => UserController::class,
              "name" => "user_logout",
              "action" => "logout"
          ]
        ];
    }

}