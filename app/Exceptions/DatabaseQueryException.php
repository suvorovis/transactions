<?php

namespace transactions\Exceptions;

class DatabaseQueryException extends AbstractException
{
    /**
     * @return string
     */
    public function getUserErrorDescription(): string
    {
        return 'Database communicate error';
    }
}
