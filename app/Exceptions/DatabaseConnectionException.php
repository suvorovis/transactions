<?php

namespace transactions\Exceptions;

class DatabaseConnectionException extends AbstractException
{
    /**
     * @return string
     */
    public function getUserErrorDescription(): string
    {
        return 'Database communicate error';
    }
}
