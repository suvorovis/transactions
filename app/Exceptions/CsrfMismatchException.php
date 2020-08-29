<?php

namespace transactions\Exceptions;

class CsrfMismatchException extends AbstractException
{
    /**
     * @return string
     */
    public function getUserErrorDescription(): string
    {
        return 'CSRF mismatch';
    }
}
