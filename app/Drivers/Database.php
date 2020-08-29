<?php

namespace transactions\Drivers;

use mysqli_result;
use transactions\Config;
use transactions\Exceptions\DatabaseConnectionException;
use transactions\Exceptions\DatabaseQueryException;

class Database extends \mysqli
{
    /**
     * Database constructor.
     *
     * @param null $host
     * @param null $username
     * @param null $passwd
     * @param null $dbname
     * @param null $port
     * @param null $socket
     *
     * @throws DatabaseConnectionException|DatabaseQueryException
     */
    public function __construct(
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
            throw new DatabaseConnectionException("Database connect error {$this->connect_errno}: {$this->connect_error}");
        }
        
        $this->real_query('SET SESSION TRANSACTION ISOLATION LEVEL READ COMMITTED');
    }
    
    /**
     * @param string $q
     * @param int    $resultmode
     *
     * @return bool|mysqli_result
     *
     * @throws DatabaseQueryException
     */
    public function query($q, $resultmode = MYSQLI_STORE_RESULT)
    {
        $result = parent::query($q, $resultmode);
        if (!$result) {
            throw new DatabaseQueryException("Query error: {$this->error}\nQuery: {$q}");
        }
        return $result;
    }
    
    /**
     * @param string $q
     *
     * @return bool
     *
     * @throws DatabaseQueryException
     */
    public function real_query($q): bool
    {
        $result = parent::real_query($q);
        if (!$result) {
            throw new DatabaseQueryException("Query error: {$this->error}\nQuery: {$q}");
        }
        return true;
    }
}
