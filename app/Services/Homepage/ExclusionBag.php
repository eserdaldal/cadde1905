<?php

namespace App\Services\Homepage;

use App\Support\ContentKey;

final class ExclusionBag
{
    /**
     * @var array<string, true>
     */
    private array $keys = [];

    public function add(string $contentKey): void
    {
        $parsed = ContentKey::parse($contentKey);
        $normalized = ContentKey::make($parsed['type'], $parsed['id']);

        $this->keys[$normalized] = true;
    }

    /**
     * @param array<int, string> $contentKeys
     */
    public function addMany(array $contentKeys): void
    {
        foreach ($contentKeys as $contentKey) {
            $this->add($contentKey);
        }
    }

    public function has(string $contentKey): bool
    {
        $parsed = ContentKey::parse($contentKey);
        $normalized = ContentKey::make($parsed['type'], $parsed['id']);

        return isset($this->keys[$normalized]);
    }

    /**
     * @return array<int, string>
     */
    public function all(): array
    {
        return array_keys($this->keys);
    }

    public function isEmpty(): bool
    {
        return $this->keys === [];
    }
}
