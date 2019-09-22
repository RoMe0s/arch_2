<?php

namespace Core\Domain\Command;

use Core\Domain\Entity\Action;

interface CommandInterface
{
    public function execute(): void;

    public function rollback(Action $action): void;
}
