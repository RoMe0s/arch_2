<?php

namespace Core\Domain\Exception;

class CommandNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Command not found!');
    }

    public function getUserFriendlyMessage(): string
    {
        return 'An error occurred! Please try again later!';
    }

}
