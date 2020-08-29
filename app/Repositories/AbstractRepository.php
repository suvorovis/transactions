<?php

namespace transactions\Repositories;

use transactions\Drivers\Database;
use transactions\Exceptions\DatabaseQueryException;

abstract class AbstractRepository
{
    /**
     * @var Database
     */
    protected $db;
    /**
     * @var string
     */
    protected $table;
    
    /**
     * AbstractRepository constructor.
     *
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    /**
     * @param int $id
     *
     * @return mixed
     *
     * @throws DatabaseQueryException
     */
    public function getById(int $id)
    {
        return $this->db->query(
                "SELECT *
                FROM `{$this->table}`
                WHERE `id` = {$id}"
            )->fetch_assoc() ?? [];
    }
}
