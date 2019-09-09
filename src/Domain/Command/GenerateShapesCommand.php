<?php

namespace Core\Domain\Command;

use Core\Domain\Factory\{
    ShapeFactory,
    ActionFactory
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
        ShapeFactory $shapeFactory,
        ActionFactory $actionFactory,
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
        $shapesNumber = rand(1, self::MAX_SHAPES_NUMBER);

        $iterator = 0;
        $newShapes = [];
        while ($iterator++ < $shapesNumber) {
            $newShape = $this->shapeFactory->generate();
            $this->shapeRepository->save($newShape);
            $newShapes[] = $newShape;
        }
        $newAction = $this->actionFactory->createFromShapes($newShapes);
        $this->actionRepository->save($newAction);
    }
}
