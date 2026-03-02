# Sistema de bodegas
Este es un sistema para registrar bodegas nuevas, editar los datos de una bodega ,eliminar el registro de una bodega y listar las bodegas existentes. Además se agregó una opcion de filtrar por estado la lista de bodegas los cuales son:
activada y desactivada.

---


##  Descripción

Este sistema permite listar y editar los datos de una bodega los cuales son:
1.Código de bodega
2. Nombre de bodega
3. Dotación
4. Direccion de la bodega
5. Encargado (puede tener uno o mas encargados asociados)

La entidad encargado estara ya ingresada en la bd sin crear una interfaz para ingresar sus datos.

---

##  Tecnologías utilizadas

- PHP Versión 8.4.1
- JQuery 3.6.0
- PostgreSQL Versión 16
- AJAX

## Ejecución del sistema 

1. Clonar el reposito con git clone https://github.com/patorma/pruebaTecnicaSistemaBodegaPHP
2. Una vez clonado dirigirse a la carpeta creada  de pruebaTecnicaSistemaBodegaPHP.
3.  Revisar log del proyecto con git log para ver que se encuentra en la rama main.
4. Tener previamente instalado PHP con versiones superior a la 8. Se puede tener los
   entornos de desarrollo web laragon o Xampp para tener un entorno local web que incluya
   un servidor y base de datos.
5.  Tener instalado PostgreSQL en su version 16 ya que este sistema se conecta a esta Versión
   de base de datos y si no es esta version puede haber problemas con ciertas funciones
   de este motor de base de datos.
6. Una vez se encuentre en la carpeta del proyecto revisar la carpeta SQL que tiene las sentencias
    SQL para crear las tablas involucradas y sentencias que se ocupan en el proyecto. Nota de lo
    anterior: Hay que tener creada la bd ,que le puede poner el nombre que quiera,pero si lo hace
    no olvidar ir a la carpeta config y al archivo de la clase abstracta de PHP
    conectar.php y modificar el nombre de la bd que es la variable $dbname. 
  
7.  Revisar en la raíz del proyecto el archivo index.php contenga el link del script de la version de jquery 
    ya que si no se encuentra puede crear problemas para correr el sistema.
8. Para probar el sistema ejecutar en la raíz del proyecto en la consola el siguiente comando:
    php -S localhost:8000   y ver en el navegador en esa dirección de localhost para ver la lista de bodegas con sus atributos y encargado respectivo.
    Si usted tiene  Xampp o laragon
    instalado o cualquier entorno virtual se inicia el proyecto basado en las indicaciones que tenga dichos sistemas.
   
