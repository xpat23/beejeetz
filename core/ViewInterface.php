<?php


namespace Core;


interface ViewInterface
{
    public function render(string $template,array $args);
}