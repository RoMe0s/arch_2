<?php

namespace Core\Infrastructure\Factory;

use Core\Domain\Entity\{
    Action,
    Change,
    State
};
use Core\Domain\Factory\ActionFactoryInterface;
use Illuminate\Support\Str;

class ActionFactory implements ActionFactoryInterface
{
    public function createFromChanges(array $changes): Action
    {
        return Action::recordAction(Str::uuid(), $changes);
    }

    public function createFromShapes(array $shapes): Action
    {
        $changes = [];
        foreach ($shapes as $shape) {
            $state = new State($shape->getType(), $shape->getColor());
            $changes[] = Change::create($shape->getId(), $state);
        }
        return Action::recordAction(Str::uuid(), $changes);
    }
}
