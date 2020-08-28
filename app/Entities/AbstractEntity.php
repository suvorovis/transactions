<?php

namespace transactions\Entities;

abstract class AbstractEntity
{
    public function __construct(array $data = [])
    {
        $this->fill($data);
    }
    
    public function fill(array $data): self
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists(static::class, $method)) {
                $this->{$method}($value);
            }
        }
        
        return $this;
    }
}