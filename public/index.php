<?php

use Core\Application;

//class loader
spl_autoload_register(function ($className) {
    if (substr($className, 0, 5) === "Core\\") {
        require_once __DIR__ . "/../core/" . str_replace(["Core\\", "\\"], ["", "/"], $className) . ".php";
    } elseif (substr($className, 0, 7) === "Config\\") {
        require_once __DIR__ . "/../config/" . str_replace(["Config\\", "\\"], ["", "/"], $className) . ".php";
    } else {
        require_once __DIR__ . "/../src/" . str_replace("\\", "/", $className) . ".php";
    }

});

session_start();
$app = new Application();
try {
    $app->run();
} catch (Exception $exception) {
    echo "Упс! Что то пошло не так!";
}

