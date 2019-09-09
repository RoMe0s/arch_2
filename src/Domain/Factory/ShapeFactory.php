<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\{
    ShapeType,
    ShapeColor,
    Shape
};

final class ShapeFactory extends BaseFactory
{
    public function generate(): Shape
    {
        return Shape::generate($this->generateId());
    }

    public function create(ShapeType $type, ShapeColor $color): Shape
    {
        return Shape::create($this->generateId(), $type, $color);
    }
}
