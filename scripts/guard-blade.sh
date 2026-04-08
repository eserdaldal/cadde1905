#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

echo "[guard-blade] start"

fail=0

# Tarayacağımız klasörler:
STRICT_DIRS=(
  "resources/views/pages"
  "resources/views/layouts"
  "resources/views/partials"
  "resources/views/components"
)

# Widgets zaten guard-widgets.sh ile denetleniyor -> burada hariç tutacağız
EXCLUDE_DIRS=(
  "resources/views/components/widgets"
)

is_excluded() {
  local path="$1"
  for ex in "${EXCLUDE_DIRS[@]}"; do
    # path ex ile başlıyorsa exclude
    if [[ "$path" == "$ex"* ]]; then
      return 0
    fi
  done
  return 1
}

scan_files() {
  local dir="$1"

  # yoksa geç
  [ -d "$dir" ] || return 0

  # exclude ise geç
  if is_excluded "$dir"; then
    return 0
  fi

  # dir altındaki .blade.php dosyalarını gez (exclude subtree: widgets)
  while IFS= read -r -d '' f; do
    # exclude subtree dosyası mı?
    for ex in "${EXCLUDE_DIRS[@]}"; do
      if [[ "$f" == "$ex/"* ]]; then
        continue 2
      fi
    done

    # 1) Blade içinde ham PHP blok yasak: @php / @endphp
    if grep -n -E '^[[:space:]]*@php\b|^[[:space:]]*@endphp\b' "$f" >/dev/null 2>&1; then
      echo "FAIL: Blade içinde @php/@endphp bulundu: $f"
      grep -n -E '^[[:space:]]*@php\b|^[[:space:]]*@endphp\b' "$f" || true
      echo "----"
      fail=1
    fi

    # 1b) Blade içinde raw PHP tag yasak: <?php / <?= (çok kritik kaçak)
    if grep -n -E '<\?(php|=)' "$f" >/dev/null 2>&1; then
      echo "FAIL: Blade içinde raw PHP tag bulundu (<?php veya <?=): $f"
      grep -n -E '<\?(php|=)' "$f" || true
      echo "----"
      fail=1
    fi

    # 2) DB / Cache / Model çağrısı yasak (render-only kuralı)
    # Not: "App\\Models\\" bilinçli sert; gerekirse sonra allowlist ekleriz.
    deny_patterns=(
      'DB::'
      'Cache::'
      'App\\Models\\'
    )

    for p in "${deny_patterns[@]}"; do
      if grep -n -E "$p" "$f" >/dev/null 2>&1; then
        echo "FAIL: Blade içinde yasak pattern bulundu: $p ($f)"
        grep -n -E "$p" "$f" || true
        echo "----"
        fail=1
      fi
    done

    # 3) View içinde method çağrısı (->something()) riski: N+1 ve gizli query tetikler
    # (widgets zaten ayrı guard’da var; burada da genel component/page için koruma)
    if grep -n -E '->\s*[A-Za-z_][A-Za-z0-9_]*\s*\(' "$f" >/dev/null 2>&1; then
      echo "FAIL: Blade içinde method çağrısı bulundu (->method()): $f"
      grep -n -E '->\s*[A-Za-z_][A-Za-z0-9_]*\s*\(' "$f" || true
      echo "----"
      fail=1
    fi

  done < <(find "$dir" -type f -name "*.blade.php" -print0 2>/dev/null || true)
}

for dir in "${STRICT_DIRS[@]}"; do
  scan_files "$dir"
done

if [ "$fail" -ne 0 ]; then
  echo "[guard-blade] FAIL"
  exit 1
fi

echo "OK: blade guard temiz."