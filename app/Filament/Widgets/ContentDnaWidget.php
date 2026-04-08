<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ContentDnaWidget extends Widget
{
    protected static string $view = 'filament.widgets.content-dna-widget';

    protected static ?int $sort = -1;

    protected int | string | array $columnSpan = 'full';
}
