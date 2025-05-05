# 💸 Bank Transfer Microservice – Laravel

Este microservicio simula una transferencia bancaria entre cuentas usando Laravel 11. Fue desarrollado como parte de una prueba técnica para demostrar diseño de APIs, validaciones, control de errores y manejo de transacciones.

---

## 🚀 Stack técnico

- PHP 8.3
- Laravel 11
- SQLite (lo que viene con Laravel de base)

---

## 📂 Instalación rápida

```bash

# Clonamos el repo
git clone https://github.com/Chiva-Tron/bank-transfer-api.git
cd bank-transfer-api

# Instalamos todas las dependencias de PHP declaradas en el archivo composer.json
composer install

# Creamos el .env
cp .env.example .env

# Generamos una nueva clave de aplicación que se guarda automáticamente en el .env
php artisan key:generate

# Creamos manualmente la base de datos SQLite vacía. Laravel usará este archivo como base de datos local.
touch database/database.sqlite

# Instalamos el sistema de routing tipo API
php artisan install:api

# Ejecutamos las migraciones y corremos seeders
php artisan migrate:fresh --seed

# Iniciamos el servidor
php artisan serve
