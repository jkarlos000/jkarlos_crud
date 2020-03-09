<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Crud

Se tiene que hacer un CRUD con este proyecto, usando las mejores practicas, para crear librerias y poder asignar libros hacia dichas librerias.

#####Libreria:

- Nombre: Requerido|String|Max 50
- Direccion: Requerido|String|Max 100
- Telefono: NO Requerido|String|Max 10

#####Libro:

- Nombre: Requerido|String|Max 50
- Autor: Requerido|String|Max 100
- Paginas: Requerido|Int

Ten en cuenta que se tiene que tener una relacion entre los libros que pertenecen a una libreria.

Como extra se requiere:

- Pruebas unitarias (Sobre servicios o logica de negocios)
- Pruebas funcionales (actions de los controladores)

Cuando se mencionaba de las buenas practicas, son practicas como hacer uso de migraciones, una capa de servicios para la logica de negocios (Es decir, que no se deje la logica en el action del controlador), validaciones de Request, etc.

## Instalacion

Cuando descargues el proyecto es necesario que inicialices una nueva rama con tus nombres como prefijo, por ejemplo, usando el siguiente comando de Git:

    git create -b pedro_hernandez_crud
    
Y sobre esa rama se revisara el codigo. No importa como se ve en el frontend, incluso si no tiene diseño. Solo importa el lado del backend, es decir los actions y toda su logica.

Los requisitos para correrlo en local es que tu servidor local tenga instalado:

- PHP 7.3
- Composer 1.9.X
- MySql 5.6+

Para poder instalar este proyecto es necesario solo correr composer install

    composer install
    
Luego generar la llave

    php artisan key:generate
    
Cuando tengan todo listo, ya podrian empezar a trabajar.  
