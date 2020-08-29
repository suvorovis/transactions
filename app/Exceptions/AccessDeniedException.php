<?php

namespace transactions\Exceptions;

class AccessDeniedException extends AbstractException
{
    /**
     * @return string
     */
    public function getUserErrorDescription(): string
    {
        return 'Access denied';
    }
}
