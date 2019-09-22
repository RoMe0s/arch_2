<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\Shape;

interface ShapeFactoryInterface
{
    public function generate(): Shape;
}
