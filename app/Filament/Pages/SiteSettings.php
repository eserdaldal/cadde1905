<?php

namespace App\Filament\Pages;

use App\Services\SiteModeService;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class SiteSettings extends Page
{
    use InteractsWithForms;

    private const ALLOWED_THEME_MODES = ['dark', 'light', 'system'];

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Ayarları';
    protected static ?string $navigationGroup = 'Yönetim';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.site-settings';

    public string $site_mode = 'ghost';
    public string $theme_mode = 'dark';

    public function mount(): void
    {
        $this->site_mode = SiteModeService::getMode();
        $this->theme_mode = $this->getThemeModeFromSettings();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Radio::make('site_mode')
                    ->label('Site Modu')
                    ->options([
                        'ghost' => '👻 Ghost Mode — Tüm içerikler görünür (Demo dahil)',
                        'live'  => '🟢 Live Mode — Sadece gerçek içerik (is_demo = 0)',
                    ])
                    ->required(),
                Radio::make('theme_mode')
                    ->label('Public Tema Modu')
                    ->helperText('Dark = varsayılan koyu tema, Light = açık tema, System = ziyaretçinin cihaz tercihi.')
                    ->options([
                        'dark' => 'Dark',
                        'light' => 'Light',
                        'system' => 'System',
                    ])
                    ->required(),
            ])
            ->statePath('');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Kaydet')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $mode = $data['site_mode'] ?? 'ghost';
        $themeMode = $data['theme_mode'] ?? 'dark';

        if (! in_array($themeMode, self::ALLOWED_THEME_MODES, true)) {
            $themeMode = 'dark';
        }

        DB::table('settings')
            ->updateOrInsert(
                ['key' => 'site_mode'],
                ['value' => $mode, 'updated_at' => now()]
            );

        DB::table('settings')
            ->updateOrInsert(
                ['key' => 'theme_mode'],
                ['value' => $themeMode, 'updated_at' => now()]
            );

        Notification::make()
            ->title('Site ayarları güncellendi')
            ->success()
            ->send();
    }

    private function getThemeModeFromSettings(): string
    {
        try {
            $value = DB::table('settings')
                ->where('key', 'theme_mode')
                ->value('value');
        } catch (\Throwable) {
            return 'dark';
        }

        return in_array($value, self::ALLOWED_THEME_MODES, true)
            ? $value
            : 'dark';
    }
}
