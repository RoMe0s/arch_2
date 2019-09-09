<?php

namespace Core\Domain\Exception;

class NoShapesException extends DomainException
{
    public function __construct()
    {
        parent::__construct('Shapes not found!');
    }

    public function getUserFriendlyMessage(): string
    {
        return 'Shapes don\'t exists!';
    }

}
