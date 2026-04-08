#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

fail=0

echo "[guard-widgets] start"

WIDGET_VIEWS_DIR="resources/views/components/widgets"
WIDGET_CLASSES_DIR="app/View/Components/Widgets"

# 1) Widget view -> Widget class eşleşmesi (kebab-case -> PascalCase)
while IFS= read -r -d '' f; do
  base="$(basename "$f" .blade.php)"              # next-match
  class="$(echo "$base" | awk -F- '{for(i=1;i<=NF;i++) $i=toupper(substr($i,1,1)) substr($i,2)}1' OFS="")"  # NextMatch
  target="${WIDGET_CLASSES_DIR}/${class}.php"

  if [ ! -f "$target" ]; then
    echo "FAIL: Widget view var ama class yok: $f -> $target"
    fail=1
  fi
done < <(find "$WIDGET_VIEWS_DIR" -maxdepth 1 -type f -name "*.blade.php" -print0 2>/dev/null || true)

# 2) Performans/Temizlik kuralı: Widget blade içinde METHOD çağrısı YASAK
# Örn: $category->news(), $x->relation()->count() vs.
if grep -R -n -E '->\s*[A-Za-z_][A-Za-z0-9_]*\s*\(' "$WIDGET_VIEWS_DIR" >/dev/null 2>&1; then
  echo "FAIL: Widget blade içinde method çağrısı bulundu (N+1 riski)."
  echo "------ Bulunanlar ------"
  grep -R -n -E '->\s*[A-Za-z_][A-Za-z0-9_]*\s*\(' "$WIDGET_VIEWS_DIR" || true
  echo "------------------------"
  fail=1
fi

# 3) Widget blade içinde DB/Model/Cache/Logic YASAK (veri sadece component class'tan gelmeli)
deny_patterns=(
  'DB::'
  'Cache::'
  'App\\Models\\'
  '@php'
)

for p in "${deny_patterns[@]}"; do
  if grep -R -n -E "$p" "$WIDGET_VIEWS_DIR" >/dev/null 2>&1; then
    echo "FAIL: Widget blade içinde yasak pattern bulundu: $p"
    echo "------ Bulunanlar ------"
    grep -R -n -E "$p" "$WIDGET_VIEWS_DIR" || true
    echo "------------------------"
    fail=1
  fi
done

if [ "$fail" -ne 0 ]; then
  echo "[guard-widgets] FAIL"
  exit 1
fi

echo "OK: widgets guard temiz."
