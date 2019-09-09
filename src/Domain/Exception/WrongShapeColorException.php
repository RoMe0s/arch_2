<?php

namespace Core\Domain\Exception;

class WrongShapeColorException extends DomainException
{
    public function __construct(string $color)
    {
        parent::__construct("Shape color \"$color\" is wrong!");
    }

    public function getUserFriendlyMessage(): string
    {
        return 'Shape color is wrong!';
    }
}
