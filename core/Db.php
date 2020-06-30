<?php
namespace core;


class Db
{
    private $_pdo;

    private function getConnection()
    {
        if (!$this->pdo) {
//            соединение. В результате мы получаем переменную $this->pdo, с которым и работаем далее на протяжении всего скрипта.
            $this->pdo = new \PDO("mysql:host=localhost;dbname=loftschools", 'root', '');
        }
        return $this->_pdo;
    }

    public function fetchAll(string $query, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }
        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function fetchOne(string $query, array $params = [])
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);
        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }
        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return reset($data);
    }

}