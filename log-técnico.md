1 - Creamos un proyecto base de Laravel 
(laravel new api-bancaria)

2- Creación de clave de aplicación 
(php artisan key:generate)

3- Revisamos que el .env ya tenga SQLite

4- Creamos el model Account con su migración correspondiente
(php artisan make:model Account -m)

5- Editamos la migración para agregar a la tabla Account las columnas "owner_name" y "balance"

6- Una vez armada la migration la corremos:
(php artisan migrate)

7- Creamos un seeder para probar la API
(php artisan make:seeder AccountSeeder)

8- Agregamos el seeder de cuentas al DatabaseSeeder que es el entrypoint de Laravel para correr los seeders

9- Corremos los seeders
(php artisan db:seed)

10- Instalar php artisan install:api (nos va a crear el archivo routes/api.php)

11- Registramos la ruta /transfer en routes/api.php 
Es POST, le pega a /transfer y la action esta en el controlador TransferController es la funcion transfer

12- Creamos el controlador de la API de /transfer
(php artisan make:controller TransferController)

13- Adentro del controlador:
a- Validamos los datos
b- Iniciamos una transacción con DB:transaction
c- Simulamos errores
d- Manejamos errores
e- retornamos una respuesta en caso de transferencia exitosa

14- Creamos un Servicio para simular fallos y probar el controlador y el manejo de fallos

15- Inyectamos este servicio en el controlador

16- 