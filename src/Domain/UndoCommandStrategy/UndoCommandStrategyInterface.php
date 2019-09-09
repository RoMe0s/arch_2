<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Entity\Change;

interface UndoCommandStrategyInterface
{
    public static function support(Change $change): bool;

    public function execute(Change $change): ?string;
}
