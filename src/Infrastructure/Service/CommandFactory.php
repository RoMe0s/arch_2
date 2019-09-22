<?php

namespace Core\Infrastructure\Service;

use Core\Domain\Command\{
    ChangeColorCommand,
    GenerateShapesCommand,
    CommandInterface
};
use Core\Domain\Service\BaseCommandFactory;

class CommandFactory extends BaseCommandFactory
{
    protected function getGenerateShapesCommand(): CommandInterface
    {
        return resolve(GenerateShapesCommand::class);
    }

    protected function getChangeColorCommand(): CommandInterface
    {
        return resolve(ChangeColorCommand::class);
    }
}
