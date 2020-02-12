<?php
namespace App;

class Model {
    protected $db;

    public function __construct() {
        $dbconf = Env::get('database');
        $connectionString = $dbconf['driver'] . ':host=' .
                            $dbconf['host'] . ';dbname=' .
                            $dbconf['dbname'] . ';';
        $this->db = new Db($connectionString, $dbconf['username'], $dbconf['password'] );
    }
}