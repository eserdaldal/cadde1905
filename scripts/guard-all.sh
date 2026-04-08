docker compose exec app php artisan optimize:clear
docker compose exec app php artisan view:clear

docker compose exec app bash -lc "./scripts/guard-widgets.sh"
docker compose exec app bash -lc "./scripts/guard-blade.sh"
docker compose exec app bash -lc "./scripts/guard-frontend.sh"
docker compose exec app bash -lc "./scripts/guard-views.sh"
docker compose exec app bash -lc "./scripts/guard-assets.sh"

echo "ALL GUARDS OK"