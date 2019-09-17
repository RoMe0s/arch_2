<?php

namespace App\Service;

use Core\Domain\Command\CommandInterface;
use Illuminate\Support\Facades\DB;

class CommandHandler
{
    public static function handle(CommandInterface $command): void
    {
        DB::transaction(function () use ($command) {
            $command->execute();
        });
    }
}
