<?php

namespace Core\Infrastructure\Factory;

use Core\Domain\Entity\{
    Action,
    Change
};
use Core\Domain\Factory\ActionFactoryInterface;
use Illuminate\Support\Str;

class ActionFactory implements ActionFactoryInterface
{
    public function createFromShapes(string $type, array $shapes): Action
    {
        $changes = [];
        foreach ($shapes as $shape) {
            $changes[] = Change::create(
                $shape->getId(),
                $shape->getType(),
                $shape->getColor()
            );
        }
        return Action::createNewAction(Str::uuid(), $type, $changes);
    }
}
