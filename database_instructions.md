# Configuración de Base de Datos

Para que la aplicación funcione correctamente, necesitas crear una base de datos en phpMyAdmin.

## 1. Crear Base de Datos
*   **Nombre de la base de datos:** `mipuno_candelaria`
*   **Cotejamiento (Collation):** `utf8mb4_unicode_ci`

## 2. Crear Usuario (Opcional pero recomendado)
La aplicación está configurada para usar un usuario específico. Puedes crear este usuario O cambiar la configuración para usar `root`.

**Opción A: Crear el usuario (Recomendado para producción/similitud)**
*   **Usuario:** `mipuno_candelaria_user`
*   **Contraseña:** `mipuno_candelaria`
*   **Privilegios:** Dale todos los privilegios sobre la base de datos `mipuno_candelaria`.

**Opción B: Usar usuario root (Más fácil para desarrollo local)**
Si prefieres usar tu usuario por defecto (`root`), debes editar el archivo:
`src/Config/Database.php` y cambiar:
```php
private $user = 'root';
private $password = ''; // O tu contraseña si tienes una
```

## 3. Crear Tablas

Ejecuta el siguiente SQL en la pestaña "SQL" de phpMyAdmin seleccionando la base de datos `mipuno_candelaria`.

### Tabla `users` (Para Login Social)
Esta es la tabla necesaria para la funcionalidad de Google/Facebook Login.

```sql
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    oauth_provider ENUM('google', 'facebook', 'email') NOT NULL,
    oauth_uid VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    picture VARCHAR(255),
    locale VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY (oauth_provider, oauth_uid)
);
```

### Tabla `clientes` (Para Chat y Reservas)
El código también hace referencia a una tabla `clientes`. Si planeas usar el chat o reservas, ejecuta esto también (deducido del código):

```sql
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefono VARCHAR(50),
    password_hash VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```
