<?php

namespace Core\Domain\Exception;

class ShapeNotFoundException extends DomainException
{
    public function __construct(string $shapeId)
    {
        parent::__construct("Shape \"$shapeId\" is not found!");
    }

    public function getUserFriendlyMessage(): string
    {
        return 'Shape doesn\'t exist!';
    }

}
