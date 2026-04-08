<?php

declare(strict_types=1);

namespace App\Services\WorldCup\Sync;

interface SyncStageInterface
{
    public function name(): string;

    /**
     * @param array<string, mixed> $context
     * @return array{processed:int, skipped:int, warnings:int, errors:int}
     */
    public function run(array $context): array;
}
