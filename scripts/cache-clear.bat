@echo off
echo === Limpiando todo el cache ===
echo.

set /p MODE="Ejecutar en [L]ocal o [D]ocker? (L/D): "

if /i "%MODE%"=="D" (
    echo --- Docker: filament-cms-app ---
    docker exec filament-cms-app php artisan cache:clear
    docker exec filament-cms-app php artisan config:clear
    docker exec filament-cms-app php artisan route:clear
    docker exec filament-cms-app php artisan view:clear
    docker exec filament-cms-app php artisan event:clear
    docker exec filament-cms-app php artisan filament:clear-cached-components
    docker exec filament-cms-app php artisan permission:cache-reset
) else (
    echo --- Local ---
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    php artisan event:clear
    php artisan filament:clear-cached-components
    php artisan permission:cache-reset
)

echo.
echo === Cache limpiado correctamente ===
pause
