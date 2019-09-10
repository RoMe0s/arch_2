<?php

namespace Core\Domain\Exception;

use Core\Domain\Entity\Action;

class ActionIsFullOfChangesException extends DomainException
{
    public function __construct(Action $action)
    {
        parent::__construct("Action \"{$action->getId()}\" is full of changes!");
    }

    public function getUserFriendlyMessage(): string
    {
        return 'An error occurred! Please try again later!';
    }
}
