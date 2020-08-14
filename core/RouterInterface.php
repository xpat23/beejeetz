<?php


namespace Core;


interface RouterInterface
{

    public function getController(): ?string;

    public function getAction(): ?string;

    public function getId(): ?int;

    public function getRoute(): ?array;

    public function generate($name, $args = []): string;
}