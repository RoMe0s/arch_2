<?php

namespace Core\Domain\Exception;

abstract class DomainException extends \Exception
{
    abstract public function getUserFriendlyMessage(): string;
}
