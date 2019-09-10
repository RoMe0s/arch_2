<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\Shape;
use Core\Infrastructure\Persistence\Shape as EloquentShape;

class ShapeMapper
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

    public function map(EloquentShape $eloquentShape): Shape
    {
        $class = new \ReflectionClass(Shape::class);
        $constructor = $class->getConstructor();
        $constructor->setAccessible(true);

        $shape = $class->newInstanceWithoutConstructor();

        $type = $this->shapeTypeMapper->map($eloquentShape->type);
        $color = $this->shapeColorMapper->map($eloquentShape->color);

        $constructor->invokeArgs($shape, [$eloquentShape->id, $type, $color]);

        return $shape;
    }
}
