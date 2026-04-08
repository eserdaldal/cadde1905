<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ControlledSeedSeeder extends Seeder
{
    /**
     * Cache column listings per table to safely filter payloads.
     *
     * @var array<string, array<int, string>>
     */
    private array $columnsCache = [];

    public function run(): void
    {
        // Bu seeder "idempotent" tasarlandı: birden fazla çalıştırınca patlamamalı.
        // Ama mevcut kayıtlara dokunabilir (updateOrInsert mantığı).

        DB::transaction(function () {
            // 1) Users
            $users = $this->seedUsers();

            // 2) Categories
            $categories = $this->seedCategories();

            // 3) Tags (MODEL A: Global Tag)
            $tagsByType = $this->seedTagsGlobal();

            // 4) Category -> default tags attach (pivot)
            $this->attachDefaultTagsToCategories($categories, $tagsByType);

            // 5) Demo content
            $this->call([
                DemoContentSeeder::class,
            ]);

            $this->command?->info('✅ ControlledSeedSeeder tamamlandı.');
        });
    }

    /**
     * USERS
     * - admin@cadde1905.test (superadmin)
     * - editor@cadde1905.test (editor)
     */
    private function seedUsers(): array
    {
        $table = 'users';

        $defaultPassword = env('CONTROLLED_SEED_PASSWORD', '12345678');

        $admin = [
            'email' => 'admin@cadde1905.test',
            'name' => 'Admin',
            'role' => 'admin',
            'is_super_admin' => 1,
            'password' => Hash::make($defaultPassword),
        ];

        $editor = [
            'email' => 'editor@cadde1905.test',
            'name' => 'Editor',
            'role' => 'editor',
            'is_super_admin' => 0,
            'password' => Hash::make($defaultPassword),
        ];

        $this->safeUpdateOrInsert($table, ['email' => $admin['email']], $admin);
        $this->safeUpdateOrInsert($table, ['email' => $editor['email']], $editor);

        $adminId = $this->safeFindIdBy($table, 'email', $admin['email']);
        $editorId = $this->safeFindIdBy($table, 'email', $editor['email']);

        $this->command?->info('✅ Users seeded (admin + editor).');

        return [
            'admin_id' => $adminId,
            'editor_id' => $editorId,
        ];
    }

    /**
     * CATEGORIES
     * - Genel / Futbol / Basketbol
     * - "type" kolonunuz varsa: genel/futbol/basketbol set edilir.
     */
    private function seedCategories(): array
    {
        $table = 'categories';

        $items = [
            [
                'key' => 'genel',
                'name' => 'Genel',
                'type' => 'genel',
                'is_active' => 1,
                'sort_order' => 0,
                'parent_id' => null,
            ],
            [
                'key' => 'futbol',
                'name' => 'Futbol',
                'type' => 'futbol',
                'is_active' => 1,
                'sort_order' => 0,
                'parent_id' => null,
            ],
            [
                'key' => 'basketbol',
                'name' => 'Basketbol',
                'type' => 'basketbol',
                'is_active' => 1,
                'sort_order' => 0,
                'parent_id' => null,
            ],
        ];

        $ids = [];

        foreach ($items as $cat) {
            $payload = [
                'name' => $cat['name'],
                'title' => $cat['name'],
                'slug' => $this->slugify($cat['name']),
                'type' => $cat['type'],
                'is_active' => $cat['is_active'],
                'active' => $cat['is_active'],
                'sort_order' => $cat['sort_order'],
                'order' => $cat['sort_order'],
                'parent_id' => $cat['parent_id'],
            ];

            $this->safeUpdateOrInsert($table, ['slug' => $payload['slug']], $payload);

            $id = $this->safeFindIdBy($table, 'slug', $payload['slug']);
            $ids[$cat['key']] = $id;
        }

        $this->command?->info('✅ Categories seeded (Genel, Futbol, Basketbol).');

        return $ids;
    }

    /**
     * TAGS - MODEL A (Global Tag)
     *
     * Not:
     * - tags.tags_name_unique yüzünden "name" global unique.
     * - Bu yüzden aynı name'i farklı type ile tekrar insert ETMİYORUZ.
     */
    private function seedTagsGlobal(): array
    {
        $table = 'tags';

        $allTags = [
            'Duyuru',
            'Kulüp',
            'Tarihçe',
            'Maç',
            'Transfer',
            'Sakatlık',
            'EuroLeague',
            'Kadro',
        ];

        $tagIds = [];

        foreach ($allTags as $tagName) {
            $slug = $this->slugify($tagName);

            $payload = [
                'name' => $tagName,
                'title' => $tagName,
                'slug' => $slug,
                'type' => 'genel',
            ];

            $this->safeUpdateOrInsert($table, ['name' => $tagName], $payload);

            $id = $this->safeFindIdBy($table, 'name', $tagName);
            if ($id) {
                $tagIds[] = $id;
            }
        }

        $this->command?->info('✅ Tags seeded (global unique).');

        return [
            'genel' => $tagIds,
            'futbol' => $tagIds,
            'basketbol' => $tagIds,
        ];
    }

    /**
     * CATEGORY_TAG pivot
     * - kategori -> default tag’ler otomatik bağlı
     */
    private function attachDefaultTagsToCategories(array $categoryIds, array $tagsByType): void
    {
        $pivot = 'category_tag';

        if (!Schema::hasTable($pivot)) {
            $this->command?->warn("⚠️ Pivot tablo bulunamadı: {$pivot} (tag attach atlandı)");
            return;
        }

        $catCol = $this->guessPivotColumn($pivot, ['category_id', 'categories_id', 'categoryId']);
        $tagCol = $this->guessPivotColumn($pivot, ['tag_id', 'tags_id', 'tagId']);

        if (!$catCol || !$tagCol) {
            $this->command?->warn("⚠️ {$pivot} kolonları tespit edilemedi (attach atlandı)");
            return;
        }

        foreach ($categoryIds as $catKey => $categoryId) {
            if (!$categoryId) {
                continue;
            }

            $tagIds = $tagsByType[$catKey] ?? [];
            foreach ($tagIds as $tagId) {
                if (!$tagId) {
                    continue;
                }

                $this->safeUpdateOrInsert(
                    $pivot,
                    [$catCol => $categoryId, $tagCol => $tagId],
                    [$catCol => $categoryId, $tagCol => $tagId]
                );
            }
        }

        $this->command?->info('✅ category_tag pivot seeded (kategori -> default tags).');
    }

    private function slugify(string $value): string
    {
        $slug = Str::slug($value);
        return $slug !== '' ? $slug : Str::random(8);
    }

    private function safeUpdateOrInsert(string $table, array $unique, array $payload): void
    {
        $uniqueFiltered = $this->filterByExistingColumns($table, $unique);
        $payloadFiltered = $this->filterByExistingColumns($table, $payload);

        $now = now();
        if (in_array('updated_at', $this->getColumns($table), true)) {
            $payloadFiltered['updated_at'] = $now;
        }
        if (in_array('created_at', $this->getColumns($table), true)) {
            $payloadFiltered['created_at'] = $payloadFiltered['created_at'] ?? $now;
        }

        try {
            DB::table($table)->updateOrInsert($uniqueFiltered, $payloadFiltered);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    private function safeFindIdBy(string $table, string $column, mixed $value): ?int
    {
        if (!Schema::hasTable($table)) {
            return null;
        }

        if (!in_array($column, $this->getColumns($table), true)) {
            return null;
        }

        $row = DB::table($table)->select('id')->where($column, $value)->first();

        return $row?->id ? (int) $row->id : null;
    }

    /**
     * @return array<int, string>
     */
    private function getColumns(string $table): array
    {
        if (isset($this->columnsCache[$table])) {
            return $this->columnsCache[$table];
        }

        if (!Schema::hasTable($table)) {
            $this->columnsCache[$table] = [];
            return [];
        }

        $this->columnsCache[$table] = Schema::getColumnListing($table);

        return $this->columnsCache[$table];
    }

    private function filterByExistingColumns(string $table, array $data): array
    {
        $columns = $this->getColumns($table);

        if (empty($columns)) {
            return [];
        }

        $out = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $columns, true)) {
                $out[$key] = $value;
            }
        }

        return $out;
    }

    private function guessPivotColumn(string $table, array $candidates): ?string
    {
        $columns = $this->getColumns($table);

        foreach ($candidates as $col) {
            if (in_array($col, $columns, true)) {
                return $col;
            }
        }

        return null;
    }
}
