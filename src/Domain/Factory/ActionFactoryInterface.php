<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\Action;

interface ActionFactoryInterface
{
    public function createFromShapes(string $type, array $shapes): Action;
}
