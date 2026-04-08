<?php

namespace App\Filament\Pages;

use App\Models\WidgetOverride;
use App\Services\WidgetStateResolver;
use App\Services\Widgets\SidebarRuntimeService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class WidgetControlPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?string $navigationLabel = 'Widget Kontrol';
    protected static ?string $navigationGroup = 'Yönetim';
    protected static ?int $navigationSort = 95;
    protected static string $view = 'filament.pages.widget-control-page';

    /**
     * @var array<int, array<string, mixed>>
     */
    public array $rows = [];

    private const EDITABLE_KEYS = [
        'next-match',
        'league-table',
        'popular-content',
        'disabled-aslanlar',
    ];

    private const PROTECTED_KEYS = [
        'on-this-day',
        'dynamic-campaign',
        'join-community',
    ];

    private const NOTES_MAX_LENGTH = 500;

    public function mount(): void
    {
        $this->loadRows();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();

        return (bool) ($user?->isSuperAdmin() || $user?->isAdmin());
    }

    public function canEdit(): bool
    {
        return (bool) (Auth::user()?->isSuperAdmin());
    }

    public function save(): void
    {
        $this->authorizeSuperAdmin();

        $errors = [];
        $priorityCandidates = [];

        foreach ($this->rows as $row) {
            $key = (string) ($row['key'] ?? '');

            if ($key === '' || ! in_array($key, self::EDITABLE_KEYS, true)) {
                if ($this->isProtectedKey($key) && $this->hasOverrideAttempt($row)) {
                    $errors[] = $key;
                }
                continue;
            }

            [$overrideEnabled, $enabledError] = $this->parseOverrideEnabled($row['override_enabled'] ?? null);
            [$overridePriority, $priorityError] = $this->parsePriorityOverride($row['override_priority'] ?? null);
            [$notes, $notesError] = $this->parseNotes($row['notes'] ?? null);

            if ($enabledError || $priorityError || $notesError) {
                $errors[] = $key;
                continue;
            }

            $defaultPriority = (int) ($row['default_priority'] ?? 0);
            $effectivePriority = $overridePriority ?? $defaultPriority;
            if ($effectivePriority > 0) {
                $priorityCandidates[] = $effectivePriority;
            }

            $hasOverride = ($overrideEnabled !== null)
                || ($overridePriority !== null)
                || ($notes !== null);

            if (! $hasOverride) {
                WidgetOverride::query()->where('widget_key', $key)->delete();
                continue;
            }

            WidgetOverride::query()->updateOrCreate(
                ['widget_key' => $key],
                [
                    'is_enabled' => $overrideEnabled,
                    'priority_override' => $overridePriority,
                    'notes' => $notes,
                    'updated_by' => Auth::id(),
                ]
            );
        }

        $this->loadRows();

        if (count($errors) > 0) {
            $unique = array_values(array_unique($errors));

            Notification::make()
                ->title('Bazı kayıtlar kaydedilmedi')
                ->body('Geçersiz veya salt okunur widget(lar): ' . implode(', ', $unique))
                ->warning()
                ->send();

            return;
        }

        $duplicates = $this->findDuplicatePriorities($priorityCandidates);

        if (count($duplicates) > 0) {
            Notification::make()
                ->title('Öncelik çakışması')
                ->body('Bazı widgetlar aynı önceliğe sahip: ' . implode(', ', $duplicates))
                ->warning()
                ->send();
        }

        Notification::make()
            ->title('Widget override ayarları güncellendi')
            ->success()
            ->send();
    }

    public function resetOverride(int $index): void
    {
        $this->authorizeSuperAdmin();

        $row = $this->rows[$index] ?? null;

        if (! is_array($row)) {
            return;
        }

        $key = (string) ($row['key'] ?? '');

        if ($key === '' || ! in_array($key, self::EDITABLE_KEYS, true)) {
            if ($this->isProtectedKey($key)) {
                Notification::make()
                    ->title('Bu widget salt okunur')
                    ->warning()
                    ->send();
            }
            return;
        }

        WidgetOverride::query()->where('widget_key', $key)->delete();

        $this->loadRows();

        Notification::make()
            ->title('Override sıfırlandı')
            ->success()
            ->send();
    }

    private function authorizeSuperAdmin(): void
    {
        abort_unless($this->canEdit(), 403);
    }

    private function isProtectedKey(string $key): bool
    {
        return in_array($key, self::PROTECTED_KEYS, true);
    }

    private function hasOverrideAttempt(array $row): bool
    {
        $enabledRaw = $row['override_enabled'] ?? null;
        $priorityRaw = $row['override_priority'] ?? null;
        $notesRaw = $row['notes'] ?? null;

        if ($enabledRaw !== null && $enabledRaw !== '') {
            return true;
        }

        if ($priorityRaw !== null && $priorityRaw !== '') {
            return true;
        }

        $notes = is_string($notesRaw) ? trim($notesRaw) : '';

        return $notes !== '';
    }

    private function loadRows(): void
    {
        $registry = $this->loadRegistry();
        $overrides = $this->loadOverrides();
        $effectiveMap = $this->loadEffectiveMap($registry);

        $rows = [];

        foreach ($registry as $widget) {
            $key = (string) ($widget['key'] ?? '');

            if ($key === '') {
                continue;
            }

            $override = $overrides[$key] ?? null;
            $effective = $effectiveMap[$key] ?? [];

            $overrideEnabled = '';
            if ($override?->is_enabled !== null) {
                $overrideEnabled = $override->is_enabled ? '1' : '0';
            }

            $rows[] = [
                'key' => $key,
                'component' => (string) ($widget['component'] ?? '-'),
                'lifecycle' => (string) ($widget['lifecycle'] ?? '-'),
                'default_enabled' => (bool) ($widget['enabled'] ?? false),
                'default_priority' => (int) ($widget['priority'] ?? 0),
                'override_exists' => $override !== null,
                'override_enabled' => $overrideEnabled,
                'override_priority' => $override?->priority_override ?? null,
                'notes' => $override?->notes ?? '',
                'effective_enabled' => (bool) ($effective['effective_enabled'] ?? $effective['enabled'] ?? $widget['enabled'] ?? false),
                'effective_priority' => (int) ($effective['effective_priority'] ?? $effective['priority'] ?? $widget['priority'] ?? 0),
                'is_editable' => in_array($key, self::EDITABLE_KEYS, true),
                'is_protected' => in_array($key, self::PROTECTED_KEYS, true),
            ];
        }

        $this->rows = $rows;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function loadRegistry(): array
    {
        try {
            $service = app(SidebarRuntimeService::class);
            $reflection = new \ReflectionClass($service);
            $method = $reflection->getMethod('registry');
            $method->setAccessible(true);

            $result = $method->invoke($service);

            return is_array($result) ? $result : [];
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * @return array<string, WidgetOverride>
     */
    private function loadOverrides(): array
    {
        if (! Schema::hasTable('widget_overrides')) {
            return [];
        }

        return WidgetOverride::query()
            ->get()
            ->keyBy('widget_key')
            ->all();
    }

    /**
     * @param  array<int, array<string, mixed>>  $registry
     * @return array<string, array<string, mixed>>
     */
    private function loadEffectiveMap(array $registry): array
    {
        try {
            $resolved = app(WidgetStateResolver::class)->apply($registry);
        } catch (\Throwable) {
            $resolved = [];
        }

        $map = [];

        foreach ($resolved as $widget) {
            if (! isset($widget['key'])) {
                continue;
            }

            $map[(string) $widget['key']] = $widget;
        }

        return $map;
    }

    private function normalizeNullableBool(mixed $value): ?bool
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (bool) ((int) $value);
    }

    private function normalizeNullableInt(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (int) $value;
    }

    private function normalizeNotes(mixed $value): ?string
    {
        $notes = is_string($value) ? trim($value) : '';

        return $notes !== '' ? $notes : null;
    }

    /**
     * @return array{0: bool|null, 1: string|null}
     */
    private function parseOverrideEnabled(mixed $value): array
    {
        if ($value === null || $value === '') {
            return [null, null];
        }

        if ($value === '1' || $value === 1 || $value === true) {
            return [true, null];
        }

        if ($value === '0' || $value === 0 || $value === false) {
            return [false, null];
        }

        return [null, 'invalid_enabled'];
    }

    /**
     * @return array{0: int|null, 1: string|null}
     */
    private function parsePriorityOverride(mixed $value): array
    {
        if ($value === null || $value === '') {
            return [null, null];
        }

        $validated = filter_var($value, FILTER_VALIDATE_INT, [
            'options' => [
                'min_range' => 1,
                'max_range' => 999,
            ],
        ]);

        if ($validated === false) {
            return [null, 'invalid_priority'];
        }

        return [(int) $validated, null];
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    private function parseNotes(mixed $value): array
    {
        if ($value === null) {
            return [null, null];
        }

        if (! is_string($value)) {
            return [null, 'invalid_notes'];
        }

        $notes = trim($value);

        if ($notes === '') {
            return [null, null];
        }

        $length = function_exists('mb_strlen') ? mb_strlen($notes) : strlen($notes);

        if ($length > self::NOTES_MAX_LENGTH) {
            return [null, 'invalid_notes_length'];
        }

        return [$notes, null];
    }

    /**
     * @param array<int, int> $priorities
     * @return array<int, int>
     */
    private function findDuplicatePriorities(array $priorities): array
    {
        if (count($priorities) === 0) {
            return [];
        }

        $counts = array_count_values($priorities);

        return array_values(array_map(
            'intval',
            array_keys(array_filter($counts, fn (int $count): bool => $count > 1))
        ));
    }
}
