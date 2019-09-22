<?php

namespace Core\Domain\Service;

use Core\Domain\Command\{
    ChangeColorCommand,
    CommandInterface,
    GenerateShapesCommand
};
use Core\Domain\Entity\Action;

abstract class BaseCommandFactory
{
    private const COMMANDS = [
        GenerateShapesCommand::class => 'getGenerateShapesCommand',
        ChangeColorCommand::class => 'getChangeColorCommand'
    ];

    abstract protected function getGenerateShapesCommand(): CommandInterface;

    abstract protected function getChangeColorCommand(): CommandInterface;

    public function makeCommand(Action $action): ?CommandInterface
    {
        foreach (self::COMMANDS as $actionType => $creationMethod) {
            if ($action->getType() === $actionType) {
                return $this->$creationMethod();
            }
        }
        return null;
    }
}
