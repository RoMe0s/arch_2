<?php

namespace Core\Domain\Entity;

final class Shape
{
    private $id;

    private $type;

    private $color;

    private function __construct(string $id, ShapeType $type, ShapeColor $color)
    {
        $this->id = $id;
        $this->type = $type;
        $this->color = $color;
    }

    public static function generate(string $id): Shape
    {
        $type = ShapeType::generate();
        $color = ShapeColor::generate();
        return new self($id, $type, $color);
    }

    public static function create(string $id, ShapeType $type, ShapeColor $color): Shape
    {
        return new self($id, $type, $color);
    }

    public function changeColor(ShapeColor $color): void
    {
        $this->color = $color;
    }

    public function toggleColor(): void
    {
        $newColor = ShapeColor::generate();
        $this->color = $newColor;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): ShapeType
    {
        return $this->type;
    }

    public function getColor(): Color
    {
        return $this->color;
    }
}
