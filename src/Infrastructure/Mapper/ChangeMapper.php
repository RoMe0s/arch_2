<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\Change;
use Core\Infrastructure\Persistence\Change as EloquentChange;

class ChangeMapper
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

    public function map(EloquentChange $eloquentChange): Change
    {
        $class = new \ReflectionClass(Change::class);
        $constructor = $class->getConstructor();
        $constructor->setAccessible(true);

        $change = $class->newInstanceWithoutConstructor();

        $type = $this->shapeTypeMapper->map($eloquentChange->type);
        $color = $this->shapeColorMapper->map($eloquentChange->color);

        $constructor->invokeArgs($change, [
            $eloquentChange->shape_id,
            $type,
            $color,
        ]);

        return $change;
    }
}
