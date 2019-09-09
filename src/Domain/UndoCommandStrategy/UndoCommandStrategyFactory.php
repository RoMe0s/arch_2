<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Entity\Change;

abstract class UndoCommandStrategyFactory
{
    private const STRATEGIES = [
        CreateShapeStrategy::class => 'createCreateShapeStrategy',
        UpdateShapeStrategy::class => 'createUpdateShapeStrategy',
        DeleteShapeStrategy::class => 'createDeleteShapeStrategy'
    ];

    abstract protected function createCreateShapeStrategy(): UndoCommandStrategyInterface;

    abstract protected function createUpdateShapeStrategy(): UndoCommandStrategyInterface;

    abstract protected function createDeleteShapeStrategy(): UndoCommandStrategyInterface;

    final public function make(Change $change): ?UndoCommandStrategyInterface
    {
        foreach (self::STRATEGIES as $strategyClass => $creationMethod) {
            if ($strategyClass::support($change)) {
                return $this->$creationMethod();
            }
        }
        return null;
    }
}
