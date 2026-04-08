<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

final class EngelsizAslanlarController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.engelsiz-aslanlar.index');
    }
}
