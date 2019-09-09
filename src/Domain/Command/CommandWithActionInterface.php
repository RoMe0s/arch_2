<?php

namespace Core\Domain\Command;

interface CommandWithActionInterface
{
    public function setAction(Action $action): void;
}
