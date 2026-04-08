<?php

namespace App\Services\Homepage\Normalizers;

use App\Services\Homepage\NormalizedContentItem;

interface HomepageContentNormalizer
{
    public function supports(mixed $record): bool;

    public function normalize(mixed $record): NormalizedContentItem;
}
