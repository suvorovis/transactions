<?php

namespace transactions\Services;

class Validator
{
    public function isAmount(string $value): bool
    {
        return preg_match('/^\d+\.?\d{0,2}$/', $value) === 1;
    }
}