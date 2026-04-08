import sys

def fix_resource(filepath, model_name):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    helper = f"""
    protected static function getExistingImageOptionsForRecord(?{model_name} $record, string $context = 'gallery'): array
    {{
        $recordId = $record?->getKey();

        return Media::query()
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->latest()
            ->limit(100)
            ->get()
            ->mapWithKeys(function ($m) use ($recordId, $context) {{
                $isUsedInCurrent = false;
                if ($recordId) {{
                    $isUsedInCurrent = \\Illuminate\\Support\\Facades\\DB::table('mediaables')
                        ->where('media_id', $m.id)
                        ->where('mediable_type', {model_name}::class)
                        ->where('mediable_id', $recordId)
                        ->where('usage_type', $context)
                        ->exists();
                }}

                $prefix = '★ ' if $isUsedInCurrent else ''
                # Wait, PHP syntax... let's use proper PHP strings.
                # Actually, I'll just write the PHP code directly in the string.
            }})
            ->toArray();
    }}
"""
    # Let's write the exact PHP code.
    php_helper = f"""
    protected static function getExistingImageOptionsForRecord(?{model_name} $record, string $context = 'gallery'): array
    {{
        $recordId = $record?->getKey();

        return \\App\\Models\\Media::query()
            ->where('media_kind', 'image')
            ->where('is_active', true)
            ->latest()
            ->limit(100)
            ->get()
            ->mapWithKeys(function ($m) use ($recordId, $context) {{
                $isUsedInCurrent = false;
                if ($recordId) {{
                    $isUsedInCurrent = \\Illuminate\\Support\\Facades\\DB::table('mediaables')
                        ->where('media_id', $m->id)
                        ->where('mediable_type', {model_name}::class)
                        ->where('mediable_id', $recordId)
                        ->where('usage_type', $context)
                        ->exists();
                }}

                $prefix = $isUsedInCurrent ? '★ ' : '';
                return [$m->id => $prefix . ($m->original_name ?: basename($m->path))];
            }})
            ->toArray();
    }}
"""
    if php_helper.strip() in content:
        print(f"Helper already exists in {filepath}")
        return

    # Find the last '}'
    last_brace_index = content.rfind('}')
    if last_brace_index != -1:
        new_content = content[:last_brace_index] + php_helper + content[last_brace_index:]
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Fixed {filepath}")
    else:
        print(f"Could not find closing brace in {filepath}")

fix_resource(r'C:\laragon\www\cadde1905\app\Filament\Resources\HistoricalMatchResource.php', 'HistoricalMatch')
fix_resource(r'C:\laragon\www\cadde1905\app\Filament\Resources\SeasonArchiveResource.php', 'SeasonArchive')
