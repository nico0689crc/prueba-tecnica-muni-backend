# Sistema de Gestión de Tareas con Usuarios Múltiples

## Descripción del Proyecto

El objetivo de este proyecto es desarrollar un sistema de gestión de tareas que permita a los usuarios crear, editar, listar y eliminar tareas. Cada tarea contará con un estado (pendiente, en progreso, completada) y una prioridad (baja, media, alta). Además, las tareas podrán ser asignadas a múltiples usuarios, fomentando la colaboración. El sistema incluirá roles de usuario para gestionar permisos:

- **Administrador**: Puede gestionar todas las tareas y asignar múltiples usuarios a una tarea.
- **Usuario estándar**: Solo puede ver y editar las tareas en las que está asignado.

## Requisitos Funcionales

1. **Asignación múltiple de usuarios**: Cada tarea puede estar vinculada a uno o más usuarios. Por ejemplo, una tarea de "Preparar reporte" puede ser asignada tanto a Juan como a María.
2. **Visualización de tareas compartidas**: Los usuarios deben poder ver las tareas en las que están involucrados, junto con los nombres de los demás usuarios asignados.
3. **Gestión por administrador**: Los administradores pueden agregar o eliminar usuarios de una tarea en cualquier momento.
4. **Seguimiento de tareas**: Una tarea solo puede marcarse como completada cuando todos los usuarios asignados hayan confirmado que han finalizado su parte.

## Tecnologías Utilizadas

- **Backend**: PHP con XAMPP.
- **Base de Datos**: MySQL.
- **Frontend**: HTML, CSS, JavaScript.

## Instalación
1. Inicia el servidor Apache y MySQL desde el panel de control de XAMPP.
2. Clona este repositorio en tu máquina local:
  ```bash
  git clone https://github.com/tu-usuario/tu-repositorio.git
  ```
3. Configura el entorno en XAMPP:
  - Copia los archivos del proyecto en el directorio `htdocs`.

4. Instala las dependencias de Laravel:
  - Abre una terminal en el directorio del proyecto.
  - Ejecuta el siguiente comando para instalar las dependencias:
    ```bash
    composer install
    ```
  - Copia el archivo `.env.example` y renómbralo como `.env`:
    ```bash
    cp .env.example .env
    ```
  - Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```
  - Configura las credenciales de la base de datos en el archivo `.env`.
  - Ejecuta las migraciones para crear las tablas necesarias:
    ```bash
    php artisan migrate
    ```
  - Ejecuta los seeders para cargar datos iniciales en la base de datos:
    ```bash
    php artisan db:seed
    ```
  - Inicia el servidor de desarrollo de Laravel:
    - Ejecuta el siguiente comando para iniciar el servidor:
      ```bash
      composer dev
      ```
    - Accede al sistema desde tu navegador en `http://127.0.0.1:8000`.

## Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).
