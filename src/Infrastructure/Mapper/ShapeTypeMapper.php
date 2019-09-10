<?php

namespace Core\Infrastructure\Mapper;

use Core\Domain\Entity\ShapeType;

class ShapeTypeMapper
{
    public function map(string $typeValue): ShapeType
    {
        $class = new \ReflectionClass(ShapeType::class);
        $constructor = $class->getConstructor();

        $type = $class->newInstanceWithoutConstructor();
        $constructor->invoke($type, $typeValue);

        return $type;
    }
}
