<?php

namespace Core\Domain\Service;

use Core\Domain\Entity\Action;
use Core\Domain\Repository\{
    ActionRepositoryInterface,
    ShapeRepositoryInterface
};

final class RollbackGenerateShapesCommandHandler
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
        $relatedActions = $this->actionRepository->getAllRelated($action);
        foreach ($relatedActions as $relatedAction) {
            $this->actionRepository->delete($relatedAction);
        }

        foreach ($action->getChanges() as $change) {
            $shape = $this->shapeRepository->findById($change->getShapeId());
            $this->shapeRepository->delete($shape);
        }

        $this->actionRepository->delete($action);
    }
}
