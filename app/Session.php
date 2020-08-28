<?php

namespace transactions;

class Session
{
    public static function start(): bool
    {
        return session_start();
    }
    
    public static function stop(): bool
    {
        return session_destroy();
    }
    
    public static function authorize(string $login, string $role): void
    {
        self::set('login', $login);
        self::set('role', $role);
        session_write_close();
    }
    
    public static function authorized(): bool
    {
        return !empty(self::login());
    }
    
    public static function login(): string
    {
        return self::get('login') ?? '';
    }
    
    public static function role(): string
    {
        return self::get('role') ?? '';
    }
    
    private static function set(string $key, $value): void
    {
        $_SESSION[ $key ] = $value;
    }
    
    private static function get(string $key)
    {
        return $_SESSION[ $key ] ?? null;
    }
}