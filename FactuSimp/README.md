# FactuSimp

Factu Simp es un desarrollo de prueba para mostrar errores posibles en un cfdi.

## Requisitos del Sistema

El sistema corre con docker el cual incluye lo siguiente
- PHP 8
- Apache
- Composer

Sera necesario para ejecutarlo contar con docker, para la documentación completa puede consultar
- [Docker Documentación completa](https://docs.docker.com/engine/install/)
## Instalación

Sé envia en un zip el archivo factuSimp.zip el cual contiene todo el código necesario para este sistema de pruebas,
facor de descomprimir el archivo.

Dentro del proyecto esta el archivo DockerFile que contiene todo lo necesario para poder utilizar el sistema,
para esto dentrro del proyecto hay que ejecutar el siguiente comando para crear la imagen factu_simp

```docker build -t factu_simp .```

Despues de crear la imagen se debe crear el contenedor el cual tiene el nombre de factu_simp_japheth es importante que 
en el volumen agregue la ruta donde coloco el proyecto, para crear el contenedor debe ejecutar lo siguiente

```docker run -p 8080:80 --name factu_simp_japheth -v ${pwd}:/var/www/html factu_simp```

Ejemplo

```docker run -p 8080:80 --name factu_simp_japheth -v /home/japheth/FactuSimp:/var/www/html factu_simp```

Se creara el contenedor y podrá y para poder probar el sistema la ruta se encuentra en http://localhost:8080/list-cfdi donde encontrará un listado de los xml enviados a facturar, en la parte superior derecha hay un boton para poder crear el CDFI

En caso de querer parar el contenedor podra hacerlo ejecutando lo siguiente 

```docker stop factu_simp_japheth```

Y para volver a ejecutarlo
```docker start factu_simp_japheth```

La información guardada podra verla en la base de datos que se proporciono, no es necesario realizar migraciones, ya estan ejecutadas en la base de datos.
