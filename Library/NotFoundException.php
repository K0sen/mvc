<?php
class NotFoundException extends Exception
{
    /**
     * NotFoundException constructor.
     * @param string $message
     */
    public function __construct($message = 'Not found')
    {
        parent::__construct($message, 404);
    }
}

