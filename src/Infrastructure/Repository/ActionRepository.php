<?php

namespace Core\Infrastructure\Repository;

use Core\Domain\Repository\ActionRepositoryInterface;
use Core\Infrastructure\Mapper\ActionMapper;
use Core\Infrastructure\Persistence\Action as EloquentAction;
use Core\Domain\Entity\{
    Change,
    Action
};
use Illuminate\Database\Eloquent\Builder;
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
        $eloquentActions = EloquentAction::latest()->get();
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

    public function findFirstByType(Action $action): ?Action
    {
        $shapeIds = array_map(function (Change $change) {
            return $change->getShapeId();
        }, $action->getChanges());
        $eloquentFirstAction = EloquentAction::with('changes')
            ->whereHas('changes', function (Builder $builder) use ($shapeIds) {
                $builder->whereIn('shape_id', $shapeIds);
            })
            ->where('type', $action->getType())
            ->orderBy('created_at', 'desc')
            ->first();

        if ($eloquentFirstAction) {
            return $this->actionMapper->map($eloquentFirstAction);
        }
        return null;
    }

    public function findPreviousByType(Action $action): ?Action
    {
        $shapeIds = array_map(function (Change $change) {
            return $change->getShapeId();
        }, $action->getChanges());
        $eloquentAction = EloquentAction::find($action->getId());
        $eloquentPreviousAction = EloquentAction::with('changes')
            ->whereHas('changes', function (Builder $builder) use ($shapeIds) {
                $builder->whereIn('shape_id', $shapeIds);
            })
            ->where('created_at', '<', $eloquentAction->created_at)
            ->where('type', $action->getType())
            ->first();

        if ($eloquentPreviousAction) {
            return $this->actionMapper->map($eloquentPreviousAction);
        }
        return null;
    }

    public function findPrevious(Action $action): ?Action
    {
        $shapeIds = array_map(function (Change $change) {
            return $change->getShapeId();
        }, $action->getChanges());
        $eloquentAction = EloquentAction::find($action->getId());
        $eloquentPreviousAction = EloquentAction::with('changes')
            ->whereHas('changes', function (Builder $builder) use ($shapeIds) {
                $builder->whereIn('shape_id', $shapeIds);
            })
            ->where('created_at', '<', $eloquentAction->created_at)
            ->first();

        if ($eloquentPreviousAction) {
            return $this->actionMapper->map($eloquentPreviousAction);
        }
        return null;
    }

    public function getAllRelated(Action $action): array
    {
        $shapeIds = array_map(function (Change $change) {
            return $change->getShapeId();
        }, $action->getChanges());
        $relatedEloquentActions = EloquentAction::where('id', '!=', $action->getId())
            ->whereHas('changes', function (Builder $builder) use ($shapeIds) {
                $builder->whereIn('shape_id', $shapeIds);
            })
            ->get();

        $relatedActions = [];
        foreach ($relatedEloquentActions as $relatedEloquentAction) {
            $relatedActions[] = $this->actionMapper->map($relatedEloquentAction);
        }
        return $relatedActions;
    }

    public function save(Action $action): void
    {
        $eloquentAction = EloquentAction::updateOrCreate(
            ['id' => $action->getId()],
            ['type' => $action->getType()]
        );

        foreach ($action->getChanges() as $change) {
            $eloquentAction->changes()->updateOrCreate([
                'id' => Str::uuid(),
                'shape_id' => $change->getShapeId(),
            ], [
                'type' => $change->getType()->getValue(),
                'color' => $change->getColor()->getValue(),
            ]);
        }
    }

    public function delete(Action $action): void
    {
        EloquentAction::where('id', $action->getId())->delete();
    }
}
