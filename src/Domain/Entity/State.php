<?php

namespace Core\Domain\Entity;

final class State
{
    private $type;

    private $color;

    public function __construct(ShapeType $type, ShapeColor $color)
    {
        $this->type = $type;
        $this->color = $color;
    }

    public function getType(): ShapeType
    {
        return $this->type;
    }

    public function getColor(): ShapeColor
    {
        return $this->color;
    }
}
