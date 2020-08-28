<?php

namespace transactions\Drivers;

use transactions\Config;

class Database extends \mysqli
{
    public function __construct (
        $host = null,
        $username = null,
        $passwd = null,
        $dbname = null,
        $port = null,
        $socket = null
    ) {
        parent::__construct(
            $host ?? Config::get('dbhost'),
            $username ?? Config::get('dbuser'),
            $passwd ?? Config::get('dbpassword'),
            $dbname ?? Config::get('dbname'),
            $port ?? Config::get('dbport'),
            $socket
        );
        
        if ($this->connect_error) {
            throw new \RuntimeException("Database connect error {$this->connect_errno}: {$this->connect_error}");
        }
    
        $this->real_query('SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
    
    public function query($q, $resultmode = MYSQLI_STORE_RESULT)
    {
        $result = parent::query($q, $resultmode);
        if (!$result) {
            throw new \Error("Query error: {$this->error}\nQuery: {$q}");
        }
        return $result;
    }
    
    public function real_query($q): bool
    {
        $result = parent::real_query($q);
        if (!$result) {
            throw new \Error("Query error: {$this->error}\nQuery: {$q}");
        }
        return $result;
    }

}