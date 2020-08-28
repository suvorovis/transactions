<?php

namespace transactions\Repositories;

use transactions\Drivers\Database;

abstract class AbstractRepository
{
    /**
     * @var Database
     */
    protected $db;
    
    protected $table;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    public function getById(int $id)
    {
        return $this->db->query(
            "SELECT *
                FROM `{$this->table}`
                WHERE `id` = {$id}"
            )->fetch_assoc() ?? [];
    }
    
}