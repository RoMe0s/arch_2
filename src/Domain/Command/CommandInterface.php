<?php

namespace Core\Domain\Command;

interface CommandInterface
{
    public function execute(): void;
}
