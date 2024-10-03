### dependencias

- PHP 8.2
- Composer 
- MySql
- Laravel v11
- Apache o cualquier servidor que soporte PHP
- nodejs 20.4
-------------
### Instalation del proyecto
                
1.  Abra un terminal en la ubicación donde guardo el proyecto
2.  Ejecute el siguente comando:
` composer install`
3. Configure su .env segun la base de datos su equipo
```example
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
### Iniciar el proyecto
1, Ejecute el global.sql en su base de datos o el migrate (primero crear la base de datos "todo")

2.  Abra otra terminal en la ubicación donde guardo el proyecto y ejecute si siguente comando para las clases tailwindcss
` npm run dev`

3. Inicie el backend
` php artisan serve`

4. visualizar el proyecto en

` localhost:8000`


-------------