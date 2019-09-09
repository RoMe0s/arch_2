<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\WrongShapeTypeException;

final class ShapeType
{
    private const AVAILABLE_TYPES = [
        'square',
        'triangle',
        'circle'
    ];

    private $value;

    public function __construct(string $value)
    {
        if (!in_array($value, self::AVAILABLE_TYPES)) {
            throw new WrongShapeTypeException($value);
        }
        $this->value = $value;
    }

    public static function generate(): ShapeType
    {
        $randomValueIndex = array_rand(static::AVAILABLE_TYPES);
        $randomValue = static::AVAILABLE_TYPES[$randomValueIndex];
        return new self($randomValue);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
