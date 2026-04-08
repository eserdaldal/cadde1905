<?php

namespace App\Support;

use InvalidArgumentException;

final class ContentKey
{
    public static function make(string $type, int|string $id): string
    {
        $normalizedType = trim($type);
        $normalizedId = is_string($id) ? trim($id) : $id;

        if ($normalizedType === '') {
            throw new InvalidArgumentException('Content key type cannot be empty.');
        }

        if ($normalizedId === '' || $normalizedId === null) {
            throw new InvalidArgumentException('Content key id cannot be empty.');
        }

        return sprintf('%s:%s', $normalizedType, $normalizedId);
    }

    /**
     * @return array{type: string, id: string}
     */
    public static function parse(string $key): array
    {
        $key = trim($key);

        if ($key === '') {
            throw new InvalidArgumentException('Content key cannot be empty.');
        }

        $parts = explode(':', $key, 2);

        if (count($parts) !== 2 || trim($parts[0]) === '' || trim($parts[1]) === '') {
            throw new InvalidArgumentException(sprintf('Invalid content key format: %s', $key));
        }

        return [
            'type' => trim($parts[0]),
            'id' => trim($parts[1]),
        ];
    }

    public static function equals(string $a, string $b): bool
    {
        return trim($a) === trim($b);
    }
}
