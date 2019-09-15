<?php

namespace Core\Domain\Command;

use Core\Domain\Exception\NoShapesException;
use Core\Domain\Repository\{
    ShapeRepositoryInterface,
    ActionRepositoryInterface
};
use Core\Domain\Factory\ActionFactoryInterface;

final class ChangeColorCommand implements CommandInterface
{
    private $shapeRepository;

    private $actionFactory;

    private $actionRepository;

    public function __construct(
        ShapeRepositoryInterface $shapeRepository,
        ActionFactoryInterface $actionFactory,
        ActionRepositoryInterface $actionRepository
    ) {
        $this->shapeRepository = $shapeRepository;
        $this->actionFactory = $actionFactory;
        $this->actionRepository = $actionRepository;
    }

    public function execute(): void
    {
        $shape = $this->shapeRepository->findByRand();
        if (!$shape) {
            throw new NoShapesException();
        }
        
        $shape->toggleColor();
        $this->shapeRepository->save($shape);

        $newAction = $this->actionFactory->generateFromShapes([$shape]);
        $this->actionRepository->save($newAction);
    }
}
