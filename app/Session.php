<?php

namespace transactions;

use Exception;

class Session
{
    /**
     * @return bool
     */
    public static function start(): bool
    {
        session_name(Config::get('session.name'));
        return session_start(['read_and_close' => true]);
    }
    
    /**
     * @return bool
     */
    public static function stop(): bool
    {
        return self::open() && session_destroy();
    }
    
    /**
     * @return bool
     */
    public static function open(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_name(Config::get('session.name'));
            return session_start();
        }
        return true;
    }
    
    /**
     * @return bool
     */
    public static function close(): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return session_write_close();
        }
        return true;
    }
    
    public static function refresh(): void
    {
        self::set('time', microtime(true));
    }
    
    /**
     * @return bool
     */
    public static function expired(): bool
    {
        return self::get('time') !== null &&
            (microtime(true) - self::get('time')) >= (int)Config::get('session.lifetime');
    }
    
    /**
     * @param string $login
     * @param string $role
     */
    public static function authorize(string $login, string $role): void
    {
        self::setArray([
            'login' => $login,
            'role' => $role,
            'time' => microtime(true),
        ]);
    }
    
    /**
     * @return bool
     */
    public static function authorized(): bool
    {
        return !empty(self::login());
    }
    
    /**
     * @throws Exception
     */
    public static function setCsrf(): void
    {
        if (!self::has('csrf')) {
            self::set('csrf', bin2hex(random_bytes(32)));
        }
    }
    
    /**
     * @return string
     */
    public static function csrf(): string
    {
        return self::get('csrf') ?? '';
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
     * @param array $params
     */
    public static function setArray(array $params): void
    {
        self::open();
        foreach ($params as $key => $value) {
            $_SESSION[ $key ] = $value;
        }
        self::close();
    }
    
    /**
     * @param string $key
     * @param        $value
     */
    public static function set(string $key, $value): void
    {
        self::open();
        $_SESSION[ $key ] = $value;
        self::close();
    }
    
    /**
     * @param string $key
     *
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        return $_SESSION[ $key ] ?? null;
    }
    
    /**
     * @param string $key
     *
     * @return string|null
     */
    public static function flash(string $key): ?string
    {
        if (!self::has($key)) {
            return null;
        }
        
        $value = self::get($key);
        self::delete($key);
        
        return $value;
    }
    
    /**
     * @param string $key
     *
     * @return bool
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[ $key ]);
    }
    
    /**
     * @param string $key
     */
    public static function delete(string $key): void
    {
        if (self::has($key)) {
            self::open();
            unset($_SESSION[ $key ]);
            self::close();
        }
    }
}
