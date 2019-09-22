<?php

namespace Core\Domain\Service;

use Core\Domain\Entity\Action;
use Core\Domain\Exception\CommandNotFoundException;

final class RollbackCommandService
{
    private $commandFactory;

    public function __construct(BaseCommandFactory $commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }

    public function rollback(Action $action): void
    {
        $command = $this->commandFactory->makeCommand($action);
        if (!$command) {
            throw new CommandNotFoundException();
        }

        $command->rollback($action);
    }
}
