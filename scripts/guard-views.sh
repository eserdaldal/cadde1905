#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

cd "$ROOT"

# 1) _legacy views altında olmamalı
if [ -d resources/views/_legacy ]; then
  echo "FAIL: resources/views/_legacy bulunuyor. Bu klasör view path disinda olmali."
  exit 1
fi

# 2) _legacy tag'leri views içinde olmamalı (defansif tarama)
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

echo "OK: View guard temiz."
