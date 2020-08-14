<?php


namespace Core;


use Config\Database;

class Connection
{
    public function createPdo()
    {
        $config = (new Database())->getConfig();
        $host = $config['host'];
        $db = $config['db'];
        $user = $config['user'];
        $pass = $config['password'];
        $port = $config['port'];
        $charset = $config['charset'];

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

        return new \PDO($dsn, $user, $pass, $options);

    }

}