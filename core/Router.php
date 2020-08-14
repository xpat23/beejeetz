<?php


namespace Core;


use Config\Routing;

class Router implements RouterInterface
{

    protected $id = null;
    protected $route = null;

    public function __construct()
    {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $indexFilePath = str_replace("index.php", "",$_SERVER["SCRIPT_NAME"] );
        $path = str_replace($indexFilePath,"/",$path);
        $routes = Routing::get();
        foreach ($routes as $key => $route) {
            if (preg_match("/({id})/", $key)) {
                $pattern = str_replace(['/', "{id}"], ['\/', "[0-9]"], $key);
                if (preg_match("/$pattern/", $path)) {
                    $pattern = str_replace("{id}", "", $key);
                    $this->id = str_replace($pattern, "", $path);
                    $this->route = $route;
                }
            }
            if ($key == $path) {
                $this->route = $route;
            }
        }
    }

    public function getController(): ?string
    {
        $route = $this->getRoute();
        if (isset($route["controller"])) {
            return $route["controller"];
        } else {
            return null;
        }
    }

    public function getRoute(): ?array
    {
        return $this->route;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?string
    {
        $route = $this->getRoute();
        if (isset($route["action"])) {
            return $route["action"];
        } else {
            return "index";
        }
    }

    public function generate($name, $args = []): string
    {
        $routes = Routing::get();
        $path = null;
        foreach ($routes as $key => $item) {
            if ($item['name'] == $name) {
                $path = $key;
            }
        }
        if ($path) {
            if (isset($args['id'])) {
                $path = str_replace("{id}", $args["id"], $path);
            }
            $url = str_replace("/index.php", "", $_SERVER["SCRIPT_NAME"]);
            return $url . $path;

        }

        throw new \Exception("Route not found!");

    }

}