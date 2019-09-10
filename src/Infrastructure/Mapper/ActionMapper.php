<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\Action;
use Core\Infrastructure\Persistence\Action as EloquentAction;

class ActionMapper
{
    private $changeMapper;

    public function __construct(ChangeMapper $changeMapper)
    {
        $this->changeMapper = $changeMapper;
    }

    public function map(EloquentAction $eloquentAction): Action
    {
        $class = new \ReflectionClass(Action::class);
        $constructor = $class->getConstructor();
        $constructor->setAccessible(true);

        $action = $class->newInstanceWithoutConstructor();

        $changes = [];
        foreach ($eloquentAction->changes as $eloquentChange) {
            $changes[] = $this->changeMapper->map($eloquentChange);
        }

        $constructor->invokeArgs($action, [$eloquentAction->id, $changes]);

        return $action;
    }
}
