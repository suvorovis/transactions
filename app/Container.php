<?php

namespace transactions;

use ReflectionClass;
use ReflectionException;
use RuntimeException;

class Container
{
    public static $services = [];
    
    /**
     * @param string $class
     *
     * @return object
     * @throws RuntimeException|ReflectionException
     */
    public function get(string $class): object
    {
        if (!class_exists($class)) {
            throw new RuntimeException("Class '{$class}' doesn't exist");
        }
        
        if (isset(self::$services[$class])) {
            return self::$services[$class];
        }
        
        $reflection = new ReflectionClass($class);
        
        $constructor = $reflection->getConstructor();
        
        if ($constructor === null) {
            return self::$services[$class] = $reflection->newInstance();
        }
    
        $params = $constructor->getParameters();
        
        if (count($params) === 0) {
            return self::$services[$class] = $reflection->newInstance();
        }
        
        $args = [];
        
        foreach ($params as $param) {
            $paramClass = $param->getClass();
            
            if ($paramClass === null) {
                if (!$param->isOptional()) {
                    throw new RuntimeException("Can't get class '{$class}' argument '{$param->getName()}'");
                }
                $args[] = $param->getDefaultValue();
            }
            
            $args[] = $this->get($paramClass->getName());
        }
        
        return self::$services[$class] = $reflection->newInstanceArgs($args);
    }
}