#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

echo "[guard] start"

# 1) _legacy klasörü views altında olmamalı
if [ -d resources/views/_legacy ]; then
  echo "FAIL: resources/views/_legacy bulundu. Bu klasör view path disinda olmali."
  exit 1
fi

# 2) Eski component layout tag'leri aktif views icinde olmamali
if grep -R "<x-layouts\.app" -n resources/views >/dev/null 2>&1; then
  echo "FAIL: <x-layouts.app> aktif views icinde bulundu."
  exit 1
fi
if grep -R "<x-header\b" -n resources/views >/dev/null 2>&1; then
  echo "FAIL: <x-header> aktif views icinde bulundu."
  exit 1
fi
if grep -R "<x-footer\b" -n resources/views >/dev/null 2>&1; then
  echo "FAIL: <x-footer> aktif views icinde bulundu."
  exit 1
fi

# 3) Widget cagirma standardi: @include('components.widgets...') yasak
if grep -R "@include('components\.widgets" -n resources/views >/dev/null 2>&1; then
  echo "FAIL: @include('components.widgets...') bulundu. Sadece <x-widgets.* /> kullanilmali."
  exit 1
fi

echo "OK: frontend guard temiz."
