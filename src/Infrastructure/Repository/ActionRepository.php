<?php

namespace Core\Infrastructure\Repository;

use Core\Domain\Entity\Action;
use Core\Domain\Entity\Change;
use Core\Domain\Repository\ActionRepositoryInterface;
use Core\Infrastructure\Mapper\ActionMapper;
use Core\Infrastructure\Persistence\Action as EloquentAction;
use Illuminate\Support\Str;

class ActionRepository implements ActionRepositoryInterface
{
    private $actionMapper;

    public function __construct(ActionMapper $actionMapper)
    {
        $this->actionMapper = $actionMapper;
    }

    public function all(): array
    {
        $actions = [];
        $eloquentActions = EloquentAction::all();
        foreach ($eloquentActions as $eloquentAction) {
            $actions[] = $this->actionMapper->map($eloquentAction);
        }
        return $actions;
    }

    public function findLatestByLimit(int $limit): array
    {
        $actions = [];
        $eloquentActions = EloquentAction::latest()->limit($limit)->get();
        foreach ($eloquentActions as $eloquentAction) {
            $actions[] = $this->actionMapper->map($eloquentAction);
        }
        return $actions;
    }

    public function save(Action $action): void
    {
        $eloquentAction = EloquentAction::create(['id' => $action->getId()]);

        /** @var Change $change */
        foreach ($action->getChanges() as $change) {
            $eloquentChange = $eloquentAction->changes()
                ->create([
                    'id' => Str::uuid(),
                    'shape_id' => $change->getShapeId()
                ]);

            if ($change->hasState()) {
                $state = $change->getState();
                $eloquentChange->state()->create([
                    'id' => Str::uuid(),
                    'type' => $state->getType(),
                    'color' => $state->getColor()
                ]);
            }

            if ($change->hasPreviousState()) {
                $previousState = $change->getPreviousState();
                $eloquentChange->previousState()->create([
                    'id' => Str::uuid(),
                    'type' => $previousState->getType(),
                    'color' => $previousState->getColor()
                ]);
            }
        }
    }
}
