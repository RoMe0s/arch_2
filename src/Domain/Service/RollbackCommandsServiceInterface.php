<?php

namespace Core\Domain\Service;

interface RollbackCommandsServiceInterface
{
    public function rollbackCommands(int $limit): void;
}
