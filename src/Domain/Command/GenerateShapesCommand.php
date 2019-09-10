<?php

namespace Core\Domain\Command;

use Core\Domain\Factory\{
    ShapeFactoryInterface,
    ActionFactoryInterface
};
use Core\Domain\Repository\{
    ShapeRepositoryInterface,
    ActionRepositoryInterface
};

final class GenerateShapesCommand implements CommandInterface
{
    private const MAX_SHAPES_NUMBER = 5;

    private $shapeFactory;

    private $actionFactory;

    private $shapeRepository;

    private $actionRepository;

    public function __construct(
        ShapeFactoryInterface $shapeFactory,
        ActionFactoryInterface $actionFactory,
        ShapeRepositoryInterface $shapeRepository,
        ActionRepositoryInterface $actionRepository
    ) {
        $this->shapeFactory = $shapeFactory;
        $this->actionFactory = $actionFactory;
        $this->shapeRepository = $shapeRepository;
        $this->actionRepository = $actionRepository;
    }

    public function execute(): void
    {
        $iterator = 0;
        $newShapes = [];
        $shapesNumber = rand(1, self::MAX_SHAPES_NUMBER);

        while ($iterator++ < $shapesNumber) {
            $newShape = $this->shapeFactory->generate();
            $this->shapeRepository->save($newShape);
            $newShapes[] = $newShape;
        }
        $newAction = $this->actionFactory->createFromShapes($newShapes);
        $this->actionRepository->save($newAction);
    }
}
