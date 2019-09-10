<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\State;
use Core\Infrastructure\Persistence\State as EloquentState;

class StateMapper
{
    private $shapeTypeMapper;

    private $shapeColorMapper;

    public function __construct(
        ShapeTypeMapper $shapeTypeMapper,
        ShapeColorMapper $shapeColorMapper
    ) {
        $this->shapeTypeMapper = $shapeTypeMapper;
        $this->shapeColorMapper = $shapeColorMapper;
    }

    public function map(EloquentState $eloquentState): State
    {
        $class = new \ReflectionClass(State::class);
        $constructor = $class->getConstructor();

        $type = $this->shapeTypeMapper->map($eloquentState->type);
        $color = $this->shapeColorMapper->map($eloquentState->color);

        $state = $class->newInstanceWithoutConstructor();
        $constructor->invokeArgs($state, [$type, $color]);

        return $state;
    }
}
