<?php

namespace Core\Domain\Exception;

class WrongShapeTypeException extends DomainException
{
    public function __construct(string $type)
    {
        parent::__construct("Shape type \"$type\" is wrong!");
    }

    public function getUserFriendlyMessage(): string
    {
        return 'Shape type is wrong!';
    }
}
