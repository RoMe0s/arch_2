<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\{
    Action,
    Change,
    State
};

final class ActionFactory extends BaseFactory
{
    public function createFromChanges(array $changes): Action
    {
        return Action::recordAction($this->generateId(), $changes);
    }

    public function createFromShapes(array $shapes): Action
    {
        $changes = [];
        foreach ($shapes as $shape) {
            $state = new State($shape->getType(), $shape->getColor());
            $changes[] = Change::create($shape->getId(), $state);
        }
        return Action::recordAction($this->generateId(), $changes);
    }
}
