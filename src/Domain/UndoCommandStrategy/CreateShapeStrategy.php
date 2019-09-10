<?php

namespace Core\Domain\UndoCommandStrategy;

use Core\Domain\Factory\ShapeFactoryInterface;
use Core\Domain\Repository\ShapeRepositoryInterface;
use Core\Domain\Entity\Change;

final class CreateShapeStrategy implements UndoCommandStrategyInterface
{
    private $shapeFactory;

    private $shapeRepository;

    public function __construct(
        ShapeFactoryInterface $shapeFactory,
        ShapeRepositoryInterface $shapeRepository
    ) {
        $this->shapeFactory = $shapeFactory;
        $this->shapeRepository = $shapeRepository;
    }

    public static function support(Change $change): bool
    {
        return !$change->hasState() && $change->hasPreviousState() && !$change->getShapeId();
    }

    public function execute(Change $change): ?string
    {
        $state = $change->getState();
        $newShape = $this->shapeFactory
            ->create($state->getType(), $state->getColor());
        $this->shapeRepository->save($newShape);
        return $newShape->getId();
    }
}
