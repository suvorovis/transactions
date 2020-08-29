<?php

namespace transactions\Exceptions;

class NotFoundException extends AbstractException
{
    /**
     * @return string
     */
    public function getUserErrorDescription(): string
    {
        return 'Page not found';
    }
}
