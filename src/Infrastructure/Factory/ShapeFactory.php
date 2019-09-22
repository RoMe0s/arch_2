<?php

namespace Core\Infrastructure\Factory;

use Core\Domain\Entity\Shape;
use Core\Domain\Factory\ShapeFactoryInterface;
use Illuminate\Support\Str;

class ShapeFactory implements ShapeFactoryInterface
{
    public function generate(): Shape
    {
        return Shape::generate(Str::uuid());
    }
}
