<?php

namespace Core\Domain\Entity;

final class Change
{
    private $shapeId;

    private $state;

    private $previousState;

    private function __construct(
        string $shapeId = null,
        State $state = null,
        State $previousState = null
    ) {
        $this->shapeId = $shapeId;
        $this->state = $state;
        $this->previousState = $previousState;
    }

    public static function create(string $shapeId, State $state): Change
    {
        return new self($shapeId, $state);
    }

    public function createReflected(?string $shapeId): Change
    {
        return new self($shapeId, $this->previousState, $this->state);
    }

    public function getShapeId(): ?string
    {
        return $this->shapeId;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function getPreviousState(): ?State
    {
        return $this->previousState;
    }

    public function hasState(): bool
    {
        return (bool) $this->state;
    }

    public function hasPreviousState(): bool
    {
        return (bool) $this->previousState;
    }
}
