# Alta de Ticket - Arquitectura en tres capas

Aplicación web sencilla para registrar un nuevo Ticket utilizando arquitectura en tres capas.
Pensada para ejecutarse con **XAMPP** (Apache + MySQL + PHP).

## Estructura del proyecto


mi-proyecto/
├── public/
│   └── tickets/
│       └── crear.php          # Capa de presentación
├── negocio/
│   └── Ticket.php             # Capa de negocio
├── datos/
│   ├── Conexion.php           # Gestión de conexión a BD
│   ├── TicketRepository.php   # Capa de persistencia
│   └── crear_bd.sql           # Script para crear la base de datos
└── config/
    └── config.php             # Configuración (XAMPP / MySQL)

## Capas

### Capa de presentación (`public/tickets/crear.php`)
- Muestra el formulario (título y descripción).
- Recibe los datos del usuario.
- Inicia la operación de creación del Ticket.
- Muestra mensaje de éxito o error.

### Capa de negocio (`negocio/Ticket.php`)
- Clase `Ticket` con título, descripción y estado.
- **Regla de negocio**: al crear un Ticket, el estado se establece automáticamente como `pendiente`.
- El estado **no** lo decide el formulario; forma parte de las reglas del sistema.

### Capa de persistencia (`datos/`)
- `Conexion.php`: obtiene la conexión PDO a MySQL.
- `TicketRepository.php`: contiene el `INSERT` y guarda el Ticket.
- Las consultas SQL **no** están en el archivo del formulario.

## Por qué el INSERT está en TicketRepository
La capa de persistencia es la única responsable del acceso a la base de datos. Mantener el SQL allí permite:
- Separar responsabilidades.
- Cambiar de motor de BD sin tocar la presentación ni el negocio.
- Reutilizar la lógica de guardado.

## Por qué el estado "pendiente" es regla de negocio
El estado inicial es una decisión del dominio (reglas del sistema), no una entrada del usuario. Por eso se asigna dentro del constructor de `Ticket`, no en el formulario ni en el repositorio.

## Cómo ejecutar con XAMPP

### 1. Requisitos
- XAMPP instalado (Apache + MySQL + PHP)

### 2. Crear la base de datos
1. Abrí **phpMyAdmin**: http://localhost/phpmyadmin
2. Andá a la pestaña **SQL**
3. Copiá y ejecutá el contenido del archivo `datos/crear_bd.sql`

O desde la consola de MySQL:
bash
mysql -u root < datos/crear_bd.sql


### 3. Colocar el proyecto
Copiá la carpeta `mi-proyecto` dentro de la carpeta `htdocs` de XAMPP:

- Windows: `C:\xampp\htdocs\mi-proyecto`
- macOS / Linux: `/opt/lampp/htdocs/mi-proyecto` (o la ruta que uses)

### 4. Abrir en el navegador
http://localhost/mi-proyecto/public/tickets/crear.php

### 5. Configuración de la base de datos
El archivo `config/config.php` está preparado para XAMPP por defecto:

- Host: `localhost`
- Base de datos: `tickets`
- Usuario: `root`
- Contraseña: *(vacía)*

Si tu MySQL tiene contraseña, editá `config/config.php`.

## Base de datos

Tabla `ticket`:

| Campo       | Tipo         | Descripción                    |
|-------------|--------------|--------------------------------|
| id          | INT (PK)     | Identificador autoincremental  |
| titulo      | VARCHAR(255) | Título del ticket              |
| descripcion | TEXT         | Descripción                    |
| estado      | VARCHAR(50)  | Estado (por defecto: pendiente)|

## Nota de seguridad
Nunca subir credenciales, contraseñas ni información sensible al repositorio.
