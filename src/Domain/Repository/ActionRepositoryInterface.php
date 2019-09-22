<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Action;

interface ActionRepositoryInterface
{
    public function all(): array;

    public function findLatestByLimit(int $limit): array;

    public function findFirstByType(Action $action): ?Action;

    public function findPreviousByType(Action $action): ?Action;

    public function findPrevious(Action $action): ?Action;

    public function getAllRelated(Action $action): array;

    public function save(Action $action): void;

    public function delete(Action $action): void;
}
