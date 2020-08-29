<?php

namespace transactions\Repositories;

use transactions\Entities\User;

class UserRepository extends AbstractRepository
{
    protected $table = 'users';
    
    public function getById(int $id): User
    {
        return new User(parent::getById($id));
    }
    
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