#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

echo "[guard-assets] start"

fail=0

detect_app_url() {
  # Kullanıcı dışarıdan override edebilir
  if [ -n "${GUARD_ASSETS_URL:-}" ]; then
    echo "$GUARD_ASSETS_URL"
    return 0
  fi

  # Container içinde miyiz?
  if [ -f "/.dockerenv" ]; then
    # Docker Desktop / WSL2 için en güvenli varsayılan
    echo "http://host.docker.internal:8080"
    return 0
  fi

  # Host/WSL shell
  echo "http://localhost:8080"
  return 0
}

APP_URL="$(detect_app_url)"

# 1) public/hot bulunmamalı
if [ -f public/hot ]; then
  echo "FAIL: public/hot bulundu."
  echo "Sebep: Laravel su anda Vite build yerine dev server kullanmaya calisabilir."
  echo "Cozum: rm -f public/hot"
  echo "---- public/hot icerigi ----"
  cat public/hot || true
  echo "----------------------------"
  fail=1
fi

# 2) public/build klasoru bulunmali
if [ ! -d public/build ]; then
  echo "FAIL: public/build bulunamadi."
  echo "Sebep: Production-style asset build uretilmemis."
  echo "Cozum: npm run build"
  fail=1
fi

# 3) manifest.json bulunmali
if [ ! -f public/build/manifest.json ]; then
  echo "FAIL: public/build/manifest.json bulunamadi."
  echo "Sebep: Vite build zinciri eksik veya bozuk."
  echo "Cozum: npm run build"
  fail=1
fi

# 4) assets klasoru bulunmali
if [ ! -d public/build/assets ]; then
  echo "FAIL: public/build/assets bulunamadi."
  echo "Sebep: Build ciktisi eksik."
  echo "Cozum: npm run build"
  fail=1
fi

# Temel dosya kontrolleri fail ise HTML testine gecmeden bitir
if [ "$fail" -ne 0 ]; then
  echo "[guard-assets] FAIL"
  exit 1
fi

echo "[guard-assets] using APP_URL=$APP_URL"

# 5) Ana sayfa HTML ciktisini kontrol et
HTML="$(curl -fsS "$APP_URL" || true)"

if [ -z "$HTML" ]; then
  echo "FAIL: $APP_URL adresinden HTML alinamadi."
  echo "Sebep: uygulama calismiyor olabilir veya URL yanlis olabilir."
  echo "Cozum: uygulamanin 200 dondugunu kontrol et."
  fail=1
else
  # 5a) Dev server izi kalmis mi?
  if printf '%s' "$HTML" | grep -E 'localhost:5173|:5173' >/dev/null 2>&1; then
    echo "FAIL: HTML icinde Vite dev server izi bulundu (:5173)."
    echo "Sebep: sistem hala dev server moduna sapmis."
    echo "Cozum: public/hot silinmeli ve cache temizlenmeli."
    echo "---- Bulunan satirlar ----"
    printf '%s' "$HTML" | grep -E 'localhost:5173|:5173' || true
    echo "--------------------------"
    fail=1
  fi

  # 5b) Build asset referansi var mi?
  if ! printf '%s' "$HTML" | grep -E '/build/assets/' >/dev/null 2>&1; then
    echo "FAIL: HTML icinde /build/assets/ referansi bulunamadi."
    echo "Sebep: Blade @vite cikisi build asset'e baglanmiyor olabilir."
    echo "Cozum: Vite entegrasyonu ve build zinciri kontrol edilmeli."
    fail=1
  fi
fi

if [ "$fail" -ne 0 ]; then
  echo "[guard-assets] FAIL"
  exit 1
fi

echo "OK: assets guard temiz."