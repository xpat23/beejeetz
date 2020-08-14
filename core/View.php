<?php


namespace Core;


class View implements ViewInterface
{
    public function render(string $template,array $args)
    {
        $content = __DIR__."/../src/View/$template.php";
        include __DIR__."/../src/View/index.php";
    }

}