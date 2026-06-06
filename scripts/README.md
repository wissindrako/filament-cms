# Scripts de cache y optimización

## Archivos

| Script | Uso |
|--------|-----|
| `cache-clear.bat` | Limpia todo el cache (desarrollo, cuando algo no se actualiza) |
| `optimize.bat` | Cachea todo para producción |
| `optimize-clear.bat` | Revierte las optimizaciones (volver a desarrollo) |

Cada script pregunta si ejecutar en **Local** o **Docker** al iniciarse.

---

## Cuándo usar cada uno

### `cache-clear.bat` — Desarrollo

Úsalo cuando:
- Los cambios en configs, rutas o vistas no se reflejan
- Filament no muestra cambios en resources/pages
- Los permisos/roles no funcionan como esperado

Comandos que ejecuta:
```
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
php artisan filament:clear-cached-components
php artisan permission:cache-reset
```

### `optimize.bat` — Producción

Úsalo antes de desplegar o para mejorar el rendimiento:
- Cachea config, rutas y eventos
- Pre-compila todas las vistas Blade
- Cachea componentes de Filament e iconos

Comandos que ejecuta:
```
php artisan optimize
php artisan view:cache
php artisan event:cache
php artisan filament:optimize
php artisan icons:cache
```

### `optimize-clear.bat` — Revertir optimizaciones

Úsalo al volver a desarrollo después de haber optimizado:
```
php artisan optimize:clear
php artisan filament:optimize-clear
```

---

## Docker

Los scripts detectan el modo Docker automáticamente al preguntar `L/D`.
El contenedor de la app es `filament-cms-app` (definido en `docker-compose.yml`).

### Comandos manuales Docker

```bash
# Limpiar cache
docker exec filament-cms-app php artisan cache:clear
docker exec filament-cms-app php artisan config:clear
docker exec filament-cms-app php artisan route:clear
docker exec filament-cms-app php artisan view:clear
docker exec filament-cms-app php artisan event:clear
docker exec filament-cms-app php artisan filament:clear-cached-components
docker exec filament-cms-app php artisan permission:cache-reset

# Optimizar
docker exec filament-cms-app php artisan optimize
docker exec filament-cms-app php artisan view:cache
docker exec filament-cms-app php artisan event:cache
docker exec filament-cms-app php artisan filament:optimize
docker exec filament-cms-app php artisan icons:cache

# Revertir optimizaciones
docker exec filament-cms-app php artisan optimize:clear
docker exec filament-cms-app php artisan filament:optimize-clear
```

### Servicios disponibles

| Contenedor | Descripción | Puerto |
|------------|-------------|--------|
| `filament-cms-app` | PHP 8.3-FPM (Laravel) | — |
| `filament-cms-nginx` | Nginx | 8088 |
| `filament-cms-db` | MySQL 8.0 | — |
| `filament-cms-phpmyadmin` | phpMyAdmin | 8089 |

---

## Equivalentes en bash/Linux (local)

```bash
# cache-clear
php artisan cache:clear && php artisan config:clear && php artisan route:clear \
  && php artisan view:clear && php artisan event:clear \
  && php artisan filament:clear-cached-components && php artisan permission:cache-reset

# optimize
php artisan optimize && php artisan view:cache && php artisan event:cache \
  && php artisan filament:optimize && php artisan icons:cache

# optimize-clear
php artisan optimize:clear && php artisan filament:optimize-clear
```
