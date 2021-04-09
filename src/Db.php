<?php

class Db
{

    /** @var \PDO */
    private $pdo;
    private static $instance;
    private $log = [];


    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Одиночки не должны быть восстанавливаемыми из строк.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser= DB_USER;
        $dbPassword = DB_PASS;
        if  (!$this->pdo) {
         $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
        }
        return $this->pdo;
    }

//    получить все записи по запросу
    public function fetchAll($query, $opt = [])
    {
        $prepare = $this->getConnection()->prepare($query);
        $res = $prepare->execute($opt);

        if ($res) {
            $array = $prepare->fetchAll(\PDO::FETCH_ASSOC);
            return $array;
        }
    }
    public function fetchOne($query, $opt = [])
    {
        $prepare = $this->getConnection()->prepare($query);
        $res = $prepare->execute($opt);
        if ($res) {
            $array = $prepare->fetchAll(\PDO::FETCH_ASSOC);
            return reset($array);
        }
    }

    public function exec($query, $opt)
    {
        $prepare = $this->getConnection()->prepare($query);
        $res = $prepare->execute($opt);
        if ($res) {
            return $this->lastInsertId();
        }
        return false;
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}