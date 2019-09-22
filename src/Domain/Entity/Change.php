<?php

namespace Core\Domain\Entity;

final class Change
{
    private $type;

    private $color;

    private $shapeId;

    private function __construct(
        string $shapeId,
        ShapeType $type,
        ShapeColor $color
    ) {
        $this->type = $type;
        $this->color = $color;
        $this->shapeId = $shapeId;
    }

    public static function create(string $shapeId, ShapeType $type, ShapeColor $color): Change
    {
        return new self($shapeId, $type, $color);
    }

    public function getType(): ShapeType
    {
        return $this->type;
    }

    public function getColor(): ShapeColor
    {
        return $this->color;
    }

    public function getShapeId(): ?string
    {
        return $this->shapeId;
    }
}
