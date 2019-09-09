<?php

namespace Core\Domain\Factory;

abstract class BaseFactory
{
    abstract public function generateId(): string;
}
