<?php

namespace Core\Domain\Command;

use Core\Domain\Entity\Action;
use Core\Domain\Service\{
    GenerateShapesCommandHandler,
    RollbackGenerateShapesCommandHandler
};

final class GenerateShapesCommand implements CommandInterface
{
    private $generateShapesCommandHandler;

    private $rollbackGenerateShapesCommandHandler;

    public function __construct(
        GenerateShapesCommandHandler $generateShapesCommandHandler,
        RollbackGenerateShapesCommandHandler $rollbackGenerateShapesCommandHandler
    ) {
        $this->generateShapesCommandHandler = $generateShapesCommandHandler;
        $this->rollbackGenerateShapesCommandHandler = $rollbackGenerateShapesCommandHandler;
    }

    public function execute(): void
    {
        $this->generateShapesCommandHandler->handle();
    }

    public function rollback(Action $action): void
    {
        $this->rollbackGenerateShapesCommandHandler->handle($action);
    }
}
