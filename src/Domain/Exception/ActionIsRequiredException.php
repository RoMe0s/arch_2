<?php

namespace Core\Domain\Exception;

class ActionIsRequiredException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Action is required!');
    }

    public function getUserFriendlyMessage(): string
    {
        return 'An error occured! Please try again later!';
    }

}
