@echo off
echo === Optimizando para produccion ===
echo.

set /p MODE="Ejecutar en [L]ocal o [D]ocker? (L/D): "

if /i "%MODE%"=="D" (
    echo --- Docker: filament-cms-app ---
    docker exec filament-cms-app php artisan config:clear
    docker exec filament-cms-app php artisan optimize
    docker exec filament-cms-app php artisan view:cache
    docker exec filament-cms-app php artisan event:cache
    docker exec filament-cms-app php artisan filament:optimize
    docker exec filament-cms-app php artisan icons:cache
) else (
    echo --- Local ---
    php artisan config:clear
    php artisan optimize
    php artisan view:cache
    php artisan event:cache
    php artisan filament:optimize
    php artisan icons:cache
)

echo.
echo === Optimizacion completada ===
pause
