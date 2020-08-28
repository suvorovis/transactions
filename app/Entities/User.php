<?php

namespace transactions\Entities;

class User extends AbstractEntity
{
    protected $id;
    protected $login;
    protected $password;
    protected $role;
    protected $balance;
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id ?? 0;
    }
    
    /**
     * @param int $id
     *
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login ?? '';
    }
    
    /**
     * @param string $login
     *
     * @return User
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password ?? '';
    }
    
    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    
    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance ?? 0.00;
    }
    
    /**
     * @param float $balance
     *
     * @return User
     */
    public function setBalance(float $balance): self
    {
        $this->balance = $balance;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role ?? '';
    }
    
    /**
     * @param string $role
     *
     * @return User
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }
}