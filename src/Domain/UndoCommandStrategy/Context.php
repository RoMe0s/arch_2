<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Exception\UndoCommandStrategyNotFoundException;
use Core\Domain\Entity\Change;

final class Context
{
    private $undoCommandStrategyFactory;

    public function __construct(UndoCommandStrategyFactory $undoCommandStrategyFactory)
    {
        $this->undoCommandStrategyFactory = $undoCommandStrategyFactory;
    }

    public function handleShapeAndGetId(Change $change): ?string
    {
        $strategy = $this->undoCommandStrategyFactory->make($change);
        return $strategy->execute($change);
    }
}
