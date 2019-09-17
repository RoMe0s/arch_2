<?php

namespace Core\Infrastructure\Service;

use Core\Domain\Repository\ShapeRepositoryInterface;
use Core\Domain\Service\ShapeServiceInterface;

class ShapeService implements ShapeServiceInterface
{
    private $shapeRepository;

    public function __construct(ShapeRepositoryInterface $shapeRepository)
    {
        $this->shapeRepository = $shapeRepository;
    }

    public function get(): array
    {
        return $this->shapeRepository->all();
    }
}
