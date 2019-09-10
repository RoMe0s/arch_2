<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\Change;
use Core\Infrastructure\Persistence\Change as EloquentChange;

class ChangeMapper
{
    private $stateMapper;

    public function __construct(StateMapper $stateMapper)
    {
        $this->stateMapper = $stateMapper;
    }

    public function map(EloquentChange $eloquentChange): Change
    {
        $class = new \ReflectionClass(Change::class);
        $constructor = $class->getConstructor();
        $constructor->setAccessible(true);

        $change = $class->newInstanceWithoutConstructor();

        if ($previousState = $eloquentChange->previousState) {
            $previousState = $this->stateMapper->map($previousState);
        }

        $constructor->invokeArgs($change, [
            $eloquentChange->id,
            $this->stateMapper->map($eloquentChange->state),
            $previousState
        ]);

        return $change;
    }
}
