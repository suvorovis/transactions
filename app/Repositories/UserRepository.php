<?php

namespace transactions\Repositories;

use transactions\Entities\User;
use transactions\Exceptions\DatabaseQueryException;

class UserRepository extends AbstractRepository
{
    /**
     * @var string
     */
    protected $table = 'users';
    
    /**
     * @param int $id
     *
     * @return User
     *
     * @throws DatabaseQueryException
     */
    public function getById(int $id): User
    {
        return new User(parent::getById($id));
    }
    
    /**
     * @param string $login
     *
     * @return User
     *
     * @throws DatabaseQueryException
     */
    public function getByLogin(string $login): User
    {
        $login = $this->db->real_escape_string($login);
        
        $result = $this->db->query(
            "SELECT *
            FROM `users`
            WHERE `login` = '{$login}'"
        );
        
        return new User($result->fetch_assoc() ?? []);
    }
    
    /**
     * @param int   $userId
     * @param float $amount
     *
     * @return bool
     *
     * @throws DatabaseQueryException
     */
    public function withdraw(int $userId, float $amount): bool
    {
        $result = $this->db->real_query(
            "UPDATE `users`
            SET `balance` = `balance` - {$amount}
            WHERE `id` = {$userId} AND `balance` >= {$amount}"
        );
        
        return $result && $this->db->affected_rows === 1;
    }
}
