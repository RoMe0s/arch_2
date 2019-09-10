<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\Action;

interface ActionFactoryInterface
{
    public function createFromChanges(array $changes): Action;

    public function createFromShapes(array $shapes): Action;
}
