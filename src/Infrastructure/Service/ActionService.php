<?php

namespace Core\Infrastructure\Service;

use Core\Domain\Repository\ActionRepositoryInterface;
use Core\Domain\Service\ActionServiceInterface;

class ActionService implements ActionServiceInterface
{
    private $actionRepository;

    public function __construct(ActionRepositoryInterface $actionRepository)
    {
        $this->actionRepository = $actionRepository;
    }

    public function get(): array
    {
        return $this->actionRepository->all();
    }
}
