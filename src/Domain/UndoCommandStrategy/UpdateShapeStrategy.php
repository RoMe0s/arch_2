<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Repository\ShapeRepositoryInterface;
use Core\Domain\Entity\Change;

final class UpdateShapeStrategy implements UndoCommandStrategyInterface
{
    private $shapeRepository;

    public function __construct(ShapeRepositoryInterface $shapeRepository)
    {
        $this->shapeRepository = $shapeRepository;
    }

    public static function support(Change $change): bool
    {
        return $change->hasState() && $change->hasPreviousState() && $change->getShapeId();
    }

    public function execute(Change $change): ?string
    {
        $shape = $this->shapeRepository->findById($change->getId());
        $shape->changeColor($this->change->getColor());
        $this->shapeRepository->update($shape);
        return $shape->getId();
    }
}
