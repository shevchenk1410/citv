# CITV

Este proyecto es una aplicación Laravel para gestionar los procesos de un Centro de Inspección Tecnica Vehicular

## Requisitos

- PHP >= 8.2
- Composer
- MySQL / MariaDB u otro motor de base de datos compatible con Laravel
- Laravel >= 11.x
- NodeJS >= 20

## Pasos previos

1. Ejecutar las migraciones para generar las tablas:

   ```bash
   php artisan migrate
   ```

2. Ejecutar los seeders para llenar las tablas maestras:

   ```bash
   php artisan db:seed
   ```

3. Copiar el archivo .env.example a .env:

   ```bash
   cp .env.example .env
   ```

3. Ejecutar el servidor de pruebas
   ```bash
   php artisan serve
   ```

4. Ingresar a la carpeta nuxt e instalar dependencias
   ```bash
   cd nuxt && npm install
   ```

5. Ejecutar nuxt en modo de desarrollo
   ```bash
   npm run dev
   ```
