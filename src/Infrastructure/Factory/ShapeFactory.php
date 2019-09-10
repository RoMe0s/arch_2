<?php

namespace Core\Infrastructure\Factory;

use Core\Domain\Entity\{
    Shape,
    ShapeColor,
    ShapeType
};
use Core\Domain\Factory\ShapeFactoryInterface;
use Illuminate\Support\Str;

class ShapeFactory implements ShapeFactoryInterface
{
    public function create(ShapeType $type, ShapeColor $color): Shape
    {
        return Shape::create(Str::uuid(), $type, $color);
    }

    public function generate(): Shape
    {
        return Shape::generate(Str::uuid());
    }
}
