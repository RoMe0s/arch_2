<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\{
    ShapeType,
    ShapeColor,
    Shape
};

interface ShapeFactoryInterface
{
    public function generate(): Shape;

    public function create(ShapeType $type, ShapeColor $color): Shape;
}
