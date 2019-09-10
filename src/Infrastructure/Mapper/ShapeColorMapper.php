<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\ShapeColor;

class ShapeColorMapper
{
    public function map(string $colorValue): ShapeColor
    {
        $class = new \ReflectionClass(ShapeColor::class);
        $constructor = $class->getConstructor();

        $color = $class->newInstanceWithoutConstructor();
        $constructor->invoke($color, $colorValue);

        return $color;
    }
}
