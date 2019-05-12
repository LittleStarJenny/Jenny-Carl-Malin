<?php

class DBConnect
{
    private $host    = 'localhost';
    //private $port    = 8889;
    private $db      = 'bookshop';
    private $user    = 'root';
    private $pass    = '';
    private $charset = 'utf8mb4';
    private $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
    ];
    public $pdo;

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
