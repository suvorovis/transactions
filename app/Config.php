<?php

namespace transactions;

class Config
{
    private static $config = [];
    
    public static function set(string $key, $value): void
    {
        self::$config[$key] = $value;
    }
    
    public static function get(string $key)
    {
        return self::$config[$key] ?? null;
    }
}