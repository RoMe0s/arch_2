<?php

namespace Core\Domain\Exception;

class ActionIsFullOfChangesException extends DomainException
{
    public function __construct(Action $action)
    {
        parent::__construct("Action \"{$action->getId()}\" is full of changes!");
    }

    public function getUserFriendlyMessage(): string
    {
        return 'An error occured! Please try again later!';
    }

}
