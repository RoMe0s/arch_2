<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Action;

interface ActionRepositoryInterface
{
    public function all(): array;

    public function findLatestByLimit(int $limit): array;

    public function save(Action $action): void;
}
