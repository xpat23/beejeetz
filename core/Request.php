<?php


namespace Core;


class Request
{
    const METHOD_POST = "POST";
    const METHOD_GET = "GET";

    public function get($key, $defaultValue = null)
    {
        return $_GET[$key] ?? $defaultValue;
    }

    public function getRequest($key, $defaultValue = null)
    {
        return $_POST[$key] ?? $defaultValue;
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function methodIs($method)
    {
        return $this->getMethod() == $method;
    }

    public function addFlashMessage($name, $message)
    {
        $_SESSION[$name] = $message;
    }

    public function getFlashMessage($name)
    {
        $result = null;
        if (isset($_SESSION[$name])) {
            $result = $_SESSION[$name];
            unset($_SESSION[$name]);
        }
        return $result;
    }

}