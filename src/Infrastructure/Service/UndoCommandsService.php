<?php

namespace Core\Infrastructure\Service;

use Core\Domain\Service\UndoCommandsServiceInterface;
use Core\Domain\Repository\ActionRepositoryInterface;
use Core\Domain\Command\CommandWithActionInterface;
use Illuminate\Support\Facades\DB;

class UndoCommandsService implements UndoCommandsServiceInterface
{
    private $actionRepository;

    private $command;

    public function __construct(
        ActionRepositoryInterface $actionRepository,
        CommandWithActionInterface $command
    ) {
        $this->actionRepository = $actionRepository;
        $this->command = $command;
    }

    public function execute(int $limit): void
    {
        $actions = $this->actionRepository->findLatestByLimit($limit);

        DB::transaction(function () use ($actions) {
            foreach ($actions as $action) {
                $this->command->setAction($action);
                $this->command->execute();
            }
        });
    }
}