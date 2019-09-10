<?php

namespace Core\Domain\Service;

use Core\Domain\Command\CommandInterface;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;
}
