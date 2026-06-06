@echo off
echo === Revertiendo optimizaciones ===
echo.

set /p MODE="Ejecutar en [L]ocal o [D]ocker? (L/D): "

if /i "%MODE%"=="D" (
    echo --- Docker: filament-cms-app ---
    docker exec filament-cms-app php artisan optimize:clear
    docker exec filament-cms-app php artisan filament:optimize-clear
) else (
    echo --- Local ---
    php artisan optimize:clear
    php artisan filament:optimize-clear
)

echo.
echo === Listo (modo desarrollo) ===
pause
