<?php

namespace Core\Domain\Service;

use Core\Domain\Entity\Action;
use Core\Domain\Repository\{
    ActionRepositoryInterface,
    ShapeRepositoryInterface
};

final class RollbackChangeColorCommandHandler
{
    private $actionRepository;

    private $shapeRepository;

    public function __construct(
        ActionRepositoryInterface $actionRepository,
        ShapeRepositoryInterface $shapeRepository
    ) {
        $this->actionRepository = $actionRepository;
        $this->shapeRepository = $shapeRepository;
    }

    public function handle(Action $action): void
    {
        $firstAction = $this->actionRepository->findFirstByType($action);
        if ($firstAction->getId() === $action->getId()) {
            $previousAction = $this->actionRepository->findPreviousByType($action);
            if (!$previousAction) {
                $previousAction = $this->actionRepository->findPrevious($action);
            }

            foreach ($previousAction->getChanges() as $previousChange) {
                $shape = $this->shapeRepository->findById($previousChange->getShapeId());
                $shape->changeColor($previousChange->getColor());
                $this->shapeRepository->save($shape);
            }
        }

        $this->actionRepository->delete($action);
    }
}
