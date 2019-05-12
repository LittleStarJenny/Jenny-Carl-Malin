<?php

class DBConnect
{
    private $host    = 'my47b.sqlserver.se';
    //private $port    = 8889;
    private $db      = '237057-bookshop';
    private $user    = '237057_sz40584';
    private $pass    = 'DBSELLERI55a';
    private $charset = 'utf8mb4';
    private $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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
