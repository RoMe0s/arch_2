<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Shape;

interface ShapeRepositoryInterface
{
    public function all(): array;

    public function findById(string $id): ?Shape;

    public function findByRand(): ?Shape;

    public function save(Shape $shape): void;

    public function delete(Shape $shape): void;
}
