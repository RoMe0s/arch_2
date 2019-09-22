<?php

namespace Core\Infrastructure\Service;

use Core\Domain\Service\{
    RollbackCommandService,
    RollbackCommandsServiceInterface
};
use Core\Domain\Repository\ActionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RollbackCommandsService implements RollbackCommandsServiceInterface
{
    private $actionRepository;

    private $rollbackCommandService;

    public function __construct(
        ActionRepositoryInterface $actionRepository,
        RollbackCommandService $rollbackCommandService
    ) {
        $this->actionRepository = $actionRepository;
        $this->rollbackCommandService = $rollbackCommandService;
    }

    public function rollbackCommands(int $limit): void
    {
        $actions = $this->actionRepository->findLatestByLimit($limit);

        foreach ($actions as $action) {
            DB::transaction(function () use ($action) {
                $this->rollbackCommandService->rollback($action);
            });
        }
    }
}
