<?php

namespace Core\Infrastructure\Service;

use Core\Domain\Command\CommandInterface;
use Core\Domain\Service\CommandHandlerInterface;
use Illuminate\Support\Facades\DB;

class CommandHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command): void
    {
        DB::transaction(function () use ($command) {
            $command->execute();
        });
    }
}
