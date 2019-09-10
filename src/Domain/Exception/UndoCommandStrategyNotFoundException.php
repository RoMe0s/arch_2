<?php

namespace Core\Domain\Exception;

class UndoCommandStrategyNotFoundException extends DomainException
{
    public function __construct()
    {
        parent::__construct("Undo command strategy not found!");
    }

    public function getUserFriendlyMessage(): string
    {
        return 'An error occurred! Please try again later!';
    }

}
