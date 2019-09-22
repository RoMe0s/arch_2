<?php

namespace Core\Domain\Command;

use Core\Domain\Service\{
    ChangeColorCommandHandler,
    RollbackChangeColorCommandHandler
};
use Core\Domain\Entity\Action;

final class ChangeColorCommand implements CommandInterface
{
    private $changeColorCommandHandler;

    private $rollbackChangeColorCommandHandler;

    public function __construct(
        ChangeColorCommandHandler $changeColorCommandHandler,
        RollbackChangeColorCommandHandler $rollbackChangeColorCommandHandler
    ) {
        $this->changeColorCommandHandler = $changeColorCommandHandler;
        $this->rollbackChangeColorCommandHandler = $rollbackChangeColorCommandHandler;
    }

    public function execute(): void
    {
        $this->changeColorCommandHandler->handle();
    }

    public function rollback(Action $action): void
    {
        $this->rollbackChangeColorCommandHandler->handle($action);
    }
}
