<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\WrongShapeColorException;

final class ShapeColor
{
    private const AVAILABLE_COLORS = [
        'red',
        'green',
        'blue'
    ];

    private $value;

    public function __construct(string $value)
    {
        if (!in_array($value, self::AVAILABLE_COLORS)) {
            throw new WrongShapeColorException($value);
        }
        $this->value = $value;
    }

    public static function generate(): ShapeColor
    {
        $randomValueIndex = array_rand(static::AVAILABLE_COLORS);
        $randomValue = static::AVAILABLE_COLORS[$randomValueIndex];
        return new self($randomValue);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
