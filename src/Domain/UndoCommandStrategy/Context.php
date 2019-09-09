<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Exception\UndoCommandStrategyNotFoundException;
use Core\Domain\UndoCommandStrategy\UndoCommandStrategyFactory;
use Core\Domain\Entity\Change;

final class Context
{
    private $undoCommandStrategyFactory;

    public function __construct(UndoCommandStrategyFactory $undoCommandStrategyFactory)
    {
        $this->undoCommandStrategyFactory = $undoCommandStrategyFactory;
    }

    public function executeStrategy(Change $change): ?string
    {
        $strategy = $this->undoCommandStrategyFactory->make($change);
        if ($strategy) {
            return $strategy->execute($change);
        }
        throw new UndoCommandStrategyNotFoundException();
    }
}
