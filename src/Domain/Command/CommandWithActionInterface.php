<?php

namespace Core\Domain\Command;

use Core\Domain\Entity\Action;

interface CommandWithActionInterface
{
    public function setAction(Action $action): void;
}
