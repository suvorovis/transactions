<?php

namespace transactions;

class Session
{
    /**
     * @return bool
     */
    public static function start(): bool
    {
        return session_start();
    }
    
    /**
     * @return bool
     */
    public static function stop(): bool
    {
        return session_destroy();
    }
    
    /**
     * @param string $login
     * @param string $role
     *
     * @return bool
     */
    public static function authorize(string $login, string $role): bool
    {
        self::set('login', $login);
        self::set('role', $role);
        return session_write_close();
    }
    
    /**
     * @return bool
     */
    public static function authorized(): bool
    {
        return !empty(self::login());
    }
    
    /**
     * @return string
     */
    public static function login(): string
    {
        return self::get('login') ?? '';
    }
    
    /**
     * @return string
     */
    public static function role(): string
    {
        return self::get('role') ?? '';
    }
    
    /**
     * @param string $key
     * @param        $value
     */
    private static function set(string $key, $value): void
    {
        $_SESSION[ $key ] = $value;
    }
    
    /**
     * @param string $key
     *
     * @return string|null
     */
    private static function get(string $key): ?string
    {
        return $_SESSION[ $key ] ?? null;
    }
}
