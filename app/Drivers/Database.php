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
            $host ?? Config::get('db.host'),
            $username ?? Config::get('db.user'),
            $passwd ?? Config::get('db.password'),
            $dbname ?? Config::get('db.name'),
            $port ?? Config::get('db.port'),
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