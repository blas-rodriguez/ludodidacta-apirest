# Ejemplo de autenticación y creación de un API en Laravel 5.3
Este repositorio contiene una pequeña ejemplificación de como utilizar la autenticación en Laravel 5.3 y como crear un API para que nuestra aplicación sea consumible desde otros sistemas, por ejemplo, desde una aplicación mobile.


## ¿Como utilizar este proyecto?
- Copiar el contenido del `.env.example` al .env `cp .env.example .env`
- Crear una nueva base de datos y setearla en el `.env`
- Ejecutar en el directorio del proyecto:
    - `composer install`
    - `php artisan key:generate`
    - `php artisan migrate --seed`
    - `php artisan storage:link`
    - `php artisan serve`
- Entrá a http://localhost:8000/ayuda

## Rutas del API
El proyecto contiene un api minimamente funcional. Si estás interesado en saber como solucionar las diferentes problemáticas que se ven/comentan en el código, se aconseja, como introducción, ver la siguiente serie: https://laracasts.com/series/incremental-api-development.

Se incluye en el root del proyecto, el archivo `Taringa.postman_collection.json`, el cual es una colección de Postman (instalátelo e importala) para que puedas jugar con el API (En principio probala con estas credenciales `email: admin@admin.com`, `password:123456789`).

Las rutas con las que te vas a encontar son:
- `GET` api/v1/posts -- Lista todos los posts con paginación
- `GET` api/v1/posts/{id} -- Muestra la información de un post específico
- `GET` api/v1/users/{id}/posts -- Muestra los posts de un usuarios específico
- `POST` api/v1/login -- Nos permite loguearnos suministrando nuestro email y password
- `POST` api/v1/users/{id}/posts?api_token=... -- Creación de un post, requiere de autenticación

*Have fun!*
