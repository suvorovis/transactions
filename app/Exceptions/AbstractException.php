<?php

namespace transactions\Exceptions;

use RuntimeException;

abstract class AbstractException extends RuntimeException
{
    /**
     * @return string
     */
    public function getUserErrorDescription(): string
    {
        return 'Something went wrong';
    }
}
