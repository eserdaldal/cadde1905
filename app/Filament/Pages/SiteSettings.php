<?php

namespace App\Filament\Pages;

use App\Services\SiteModeService;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Artisan;
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
    public ?string $worldcup_stage = null;

    /**
     * @var array<int, array<string, mixed>>
     */
    public array $api_sync_actions = [];

    /**
     * @var array<string, string>
     */
    public array $worldcup_stage_options = [];

    public function mount(): void
    {
        $this->site_mode = SiteModeService::getMode();
        $this->theme_mode = $this->getThemeModeFromSettings();
        $this->api_sync_actions = $this->getApiSyncActions();
        $this->worldcup_stage_options = $this->getWorldCupStageOptions();
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

    public function syncApi(string $key): void
    {
        $this->authorizeSync();

        $action = $this->findApiSyncAction($key);

        if ($action === null) {
            Notification::make()
                ->title('API sync aksiyonu bulunamadı')
                ->warning()
                ->send();
            return;
        }

        try {
            $command = (string) $action['command'];
            $params = (array) ($action['params'] ?? []);

            Artisan::call($command, $params);
            $output = trim(Artisan::output());

            Notification::make()
                ->title('Sync tamamlandı')
                ->body($output !== '' ? $output : 'Komut başarıyla çalıştı.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            report($e);

            Notification::make()
                ->title('Sync başarısız')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function syncWorldCupFull(): void
    {
        $this->authorizeSync();

        try {
            Artisan::call('worldcup:sync');
            $output = trim(Artisan::output());

            Notification::make()
                ->title('World Cup full sync tamamlandı')
                ->body($output !== '' ? $output : 'Komut başarıyla çalıştı.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            report($e);

            Notification::make()
                ->title('World Cup sync başarısız')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function syncWorldCupStage(): void
    {
        $this->authorizeSync();

        $stage = $this->worldcup_stage;

        if ($stage === null || $stage === '' || ! array_key_exists($stage, $this->worldcup_stage_options)) {
            Notification::make()
                ->title('Stage seçilmedi')
                ->warning()
                ->send();
            return;
        }

        try {
            Artisan::call('worldcup:sync', ['--stage' => $stage]);
            $output = trim(Artisan::output());

            Notification::make()
                ->title('World Cup stage sync tamamlandı')
                ->body($output !== '' ? $output : 'Komut başarıyla çalıştı.')
                ->success()
                ->send();
        } catch (\Throwable $e) {
            report($e);

            Notification::make()
                ->title('World Cup sync başarısız')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getApiSyncActions(): array
    {
        return [
            [
                'key' => 'sports_next_match',
                'label' => 'Süper Lig — Sonraki Maç',
                'command' => 'sports:sync-match-center',
                'params' => [],
            ],
            [
                'key' => 'sports_league_table',
                'label' => 'Süper Lig — Lig Tablosu',
                'command' => 'sports:sync-standings',
                'params' => [],
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    private function getWorldCupStageOptions(): array
    {
        return [
            'tournament' => 'tournament',
            'teams' => 'teams',
            'stadiums' => 'stadiums',
            'matches' => 'matches',
            'players' => 'players',
            'standings' => 'standings',
        ];
    }

    private function findApiSyncAction(string $key): ?array
    {
        foreach ($this->api_sync_actions as $action) {
            if (($action['key'] ?? null) === $key) {
                return $action;
            }
        }

        return null;
    }

    private function authorizeSync(): void
    {
        $user = auth()->user();

        if (! $user || (! $user->isAdmin() && ! $user->isSuperAdmin())) {
            abort(403);
        }
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
