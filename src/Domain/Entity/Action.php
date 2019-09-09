<?php

namespace Core\Domain\Entity;

final class Action
{
    private $id;

    private $changes;

    private function __construct(string $id, array $changes = [])
    {
        $this->id = $id;
        $this->changes = $changes;
    }

    public static function recordAction(string $id, array $changes = []): Action
    {
        return new self($id, $changes);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getChanges(): array
    {
        return $this->changes;
    }
}
