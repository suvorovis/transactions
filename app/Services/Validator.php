<?php

namespace transactions\Services;

class Validator
{
    /**
     * @param string $value
     *
     * @return bool
     */
    public function isAmount(string $value): bool
    {
        return preg_match('/^\d+\.?\d{0,2}$/', $value) === 1;
    }
    
    /**
     * @param string $value
     *
     * @return bool
     */
    public function isEmpty(string $value): bool
    {
        return empty($value);
    }
}
