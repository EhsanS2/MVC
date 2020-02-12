<?php
namespace App;

class Model {
    private $_db;

    public function __construct() {
        $dbconf = Env::get('database');
        try {
            $connectionString = $dbconf['driver'] . ':host=' .
                                $dbconf['host'] . ';dbname=' .
                                $dbconf['dbname'] . ';charset=' .
                                $dbconf['charset'];
            $this->_db = new Db($connectionString, $dbconf['username'], $dbconf['password']);
        } catch (\PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function db() {
        return $this->_db;
    }
}