<?php

namespace Core\Domain\Service;

use Core\Domain\Command\ChangeColorCommand;
use Core\Domain\Repository\{
    ShapeRepositoryInterface,
    ActionRepositoryInterface
};
use Core\Domain\Exception\NoShapesException;
use Core\Domain\Factory\ActionFactoryInterface;

final class ChangeColorCommandHandler
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

    public function handle(): void
    {
        $shape = $this->shapeRepository->findByRand();
        if (!$shape) {
            throw new NoShapesException();
        }

        $shape->toggleColor();
        $this->shapeRepository->save($shape);

        $newAction = $this->actionFactory
            ->createFromShapes(ChangeColorCommand::class, [$shape]);
        $this->actionRepository->save($newAction);
    }
}
