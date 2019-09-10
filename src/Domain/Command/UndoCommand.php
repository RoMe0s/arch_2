<?php

namespace Core\Domain\Command;

use Core\Domain\UndoCommandStrategy\Context as StrategyContext;
use Core\Domain\Factory\ActionFactoryInterface;
use Core\Domain\Repository\ActionRepositoryInterface;
use Core\Domain\Entity\Action;
use Core\Domain\Exception\ActionIsRequiredException;

final class UndoCommand implements CommandInterface, CommandWithActionInterface
{
    private $strategyContext;

    private $actionFactory;

    private $actionRepository;

    private $action;

    public function __construct(
        StrategyContext $strategyContext,
        ActionFactoryInterface $actionFactory,
        ActionRepositoryInterface $actionRepository
    ) {
        $this->strategyContext = $strategyContext;
        $this->actionFactory = $actionFactory;
        $this->actionRepository = $actionRepository;
    }

    public function setAction(Action $action): void
    {
        $this->action = $action;
    }

    public function execute(): void
    {
        if (!$this->action) {
            throw new ActionIsRequiredException();
        }

        $newChanges = [];
        foreach ($this->action->getChanges() as $change) {
            $newShapeId = $this->strategyContext->handleShapeAndGetId($change);
            $newChange = $change->createReflected($newShapeId);
            $newChanges[] = $newChange;
        }
        $newAction = $this->actionFactory->createFromChanges($newChanges);
        $this->actionRepository->save($newAction);
    }
}
