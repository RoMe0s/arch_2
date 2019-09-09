<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Repository\ShapeRepositoryInterface;
use Core\Domain\Entity\Change;

final class DeleteShapeStrategy implements UndoCommandStrategyInterface
{
    private $shapeRepository;

    public function __construct(ShapeRepositoryInterface $shapeRepository)
    {
        $this->shapeRepository = $shapeRepository;
    }

    public static function support(Change $change): bool
    {
        return $change->hasState() && !$change->hasPreviousState() && $change->getShapeId();
    }

    public function execute(Change $change): ?string
    {
        $shape = $this->shapeRepository->findById($change->getId());
        $this->shapeRepository->delete($shape);
        return null;
    }
}
