<?php


namespace Config;


class Database
{
    public function getConfig()
    {
        return [
            'host' => '127.0.0.1',
            'db' => 'test',
            'user' => 'root',
            'password' => "6230",
            "port" => '3306',
            "charset" => 'utf8'
        ];
    }

}