<?php

namespace transactions;

class Config
{
    /**
     * @var array
     */
    private static $config = [];
    
    /**
     * @param string $key
     * @param        $value
     */
    public static function set(string $key, string $value): void
    {
        self::$config[ $key ] = $value;
    }
    
    /**
     * @param string $key
     *
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        return self::$config[ $key ] ?? null;
    }
}
