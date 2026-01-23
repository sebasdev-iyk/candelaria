# 🎭 Festividad Virgen de la Candelaria 2026 - Documentación Técnica Completa

![Candelaria Banner](assets/img/banner_readme.jpg)

> **Versión**: 2.0.0 (Release Candidate)  
> **Estado**: Producción / Estable  
> **Desarrollado por**: Candela Digital Team

Este documento constituye la referencia técnica definitiva para la plataforma web de la **Festividad Virgen de la Candelaria 2026**. Cubre arquitectura, bases de datos, APIs, frontend, despliegue y manual de contribución con un nivel de detalle exhaustivo.

---

## 📑 Tabla de Contenidos

1. [Visión General del Proyecto](#visión-general-del-proyecto)
2. [Arquitectura del Sistema](#arquitectura-del-sistema)
3. [Estructura de Directorios](#estructura-de-directorios)
4. [Módulos Principales](#módulos-principales)
    - [Plataforma En Vivo](#1-plataforma-en-vivo-live-platform)
    - [Chatbot con IA](#2-chatbot-con-ia-chatbot)
    - [Directorio de Servicios](#3-directorio-de-servicios-servicios)
    - [Agenda y Cultura](#4-agenda-y-cultura)
5. [Referencia de Base de Datos](#referencia-de-base-de-datos)
6. [Documentación de API](#documentación-de-api)
    - [Autenticación](#api-autenticación)
    - [Clientes y Reservas](#api-clientes-y-reservas)
    - [Servicios y Calificaciones](#api-servicios)
7. [Guía de Clases Backend](#guía-de-clases-backend)
8. [Frontend y Assets](#frontend-y-assets)
9. [Seguridad y Rendimiento](#seguridad-y-rendimiento)
10. [Guía de Instalación y Despliegue](#guía-de-instalación-y-despliegue)
11. [Troubleshooting](#troubleshooting)

---

## 🔭 Visión General del Proyecto

La plataforma **Candelaria 2026** es una solución web integral diseñada para digitalizar la experiencia de la festividad más grande del Perú. No es solo un sitio informativo, sino una **PWA (Progressive Web App)** funcional que ofrece:

*   **Geolocalización en Tiempo Real**: Rastreo GPS de comparsas.
*   **Interacción Social**: Chat en vivo y sistema de comentarios.
*   **Comercio Electrónico**: Reservas de hoteles y gastronomía.
*   **Inteligencia Artificial**: Asistente virtual contextual.

El sistema está construido siguiendo principios de **arquitectura monolítica modular**, priorizando la velocidad de carga (milisegundos) y la resiliencia ante alto tráfico.

---

## 🏗️ Arquitectura del Sistema

### Stack Tecnológico

| Capa | Tecnología | Descripción |
| :--- | :--- | :--- |
| **Backend** | PHP 8.2 | Sin frameworks pesados. Arquitectura MVC propia ("Nano-MVC"). |
| **Database** | MySQL 8.0 / MariaDB 10.6 | Motor InnoDB. ACID compliant. |
| **Frontend** | HTML5, JS (ES6+) | Vanilla JS para máximo rendimiento. Sin React/Vue. |
| **Estilos** | TailwindCSS 3.4 | Utility-first CSS via CDN (o build process). |
| **Mapas** | Leaflet.js | Renderizado de mapas OpenStreetMap/CartoDB. |
| **IA** | Groq API | Modelo Llama-3-70b-Versatile para inferencia rápida. |
| **Server** | Apache 2.4 | Con `mod_rewrite` y `mod_headers`. |

### Flujo de Datos
1.  **Cliente (Browser)**: Realiza peticiones `fetch` asíncronas a los endpoints JSON en `/api/`.
2.  **Router**: Apache maneja las rutas amigables o directas a archivos `.php`.
3.  **Controller/Service**: Scripts PHP (ej: `api/auth.php`) procesan la lógica, validan input y llaman a clases de servicio.
4.  **Model/DB**: `src/Config/Database.php` gestiona la conexión PDO Singleton.
5.  **Respuesta**: Se devuelve JSON estrictamente tipado (`Content-Type: application/json`).

---

## 📂 Estructura de Directorios

El proyecto sigue una estructura semántica donde cada carpeta raíz es un módulo funcional.

```text
/var/www/html/php-candelaria/candelaria/
├── api/                        # 📡 ENDPOINTS DE API (Backend)
│   ├── auth.php                # Login social (Google/Facebook)
│   ├── auth_email.php          # Login/Registro tradicional
│   ├── clientes.php            # CRUD de perfil de usuario
│   ├── reservar.php            # Lógica transaccional de reservas
│   ├── disponibilidad.php      # Consulta de habitaciones libres
│   ├── calificaciones.php      # Sistema de ratings y reviews
│   ├── chat.php                # Polling y envío de mensajes (Live)
│   ├── hospedaje.php           # GET listado de hoteles
│   └── ...
├── assets/                     # 🎨 RECURSOS ESTÁTICOS
│   ├── css/                    # Estilos globales (sparks.css, etc.)
│   ├── js/                     # Scripts globales
│   ├── img/                    # Logos, banners, placeholders
│   └── uploads/                # Cargas de usuarios (avatars, comprobantes)
├── chatbot/                    # 🤖 MÓDULO IA
│   ├── api/                    # Backend específico del bot
│   │   ├── GroqService.php     # Cliente API para Groq
│   │   ├── DatabaseService.php # RAG (Retrieval Augmented Generation) simple
│   │   └── chat.php            # Endpoint principal del bot
│   ├── assets/                 # Videos del avatar (webm con alfa)
│   ├── script.js               # Lógica de Canvas y Chroma Key
│   └── style.css               # Estilos del widget flotante
├── database/                   # 💾 ESQUEMAS SQL
│   ├── EJECUTAR_ESTO.sql       # Script maestro de instalación
│   ├── auth_advanced.sql       # Tablas de usuarios y seguridad
│   └── scripts/                # Migraciones incrementales
├── horarios_y_danzas/          # 📅 MÓDULO AGENDA
├── includes/                   # 🧩 LIBRERÍAS COMPARTIDAS
│   ├── auth_config.php         # Constantes y API Keys
│   ├── auth-header.php         # Lógica de sesión y navbar
│   ├── db.php                  # (Legacy) Conexión antigua
│   ├── ActivityLogger.php      # Clase de auditoría
│   └── EmailService.php        # Clase de envío de correos
├── live-platform/              # 🔴 MÓDULO STREAMING
│   ├── includes/               # Helpers de video
│   ├── index.php               # Vista principal del player
│   └── script.js               # Lógica de WebSocket simulado (polling)
├── servicios/                  # 🏨 MÓDULO TURÍSTICO
│   ├── index.php               # Buscador principal
│   └── styles.css              # Estilos específicos de tarjetas
├── src/                        # 🏗️ NÚCLEO (PSR-4 Friendly)
│   └── Config/
│       └── Database.php        # Clase Singleton de conexión BD
├── index.php                   # Landing Page (Hero, Countdown)
└── Dockerfile                  # Configuración de contenedor
```

---

## 🧩 Módulos Principales

### 1. Plataforma En Vivo (`live-platform`)
Diseñada para soportar miles de usuarios concurrentes.
*   **Player Híbrido**: Soporta iframes de YouTube, Facebook Watch y streams RTMP directos.
*   **Chat Híbrido**: 
    *   Usa `api/chat.php` con *long-polling* (2s de intervalo) para simular tiempo real sin sobrecargar sockets.
    *   Persistencia en tabla `chat_messages` (limpieza automática cada 24h).
*   **Mapa GPS**:
    *   Consume `api/admin/mapa.php` para obtener coordenadas `lat,lng`.
    *   Renderiza marcadores personalizados con iconos de danza usando `L.divIcon` de Leaflet.

### 2. Chatbot con IA (`chatbot`)
Un asistente que "habla" visualmente.
*   **Avatar de Video**:
    *   Usa `<canvas>` para procesar un video `.webm` de una presentadora.
    *   Algoritmo de *Green Screen Removal* en JS (`metrics: r<40, g<40, b<40`) para transparencia en tiempo real.
*   **Cerebro (Groq Llama 3)**:
    *   El `GroqService.php` construye un prompt de sistema inyectando contexto de la base de datos (horarios, hoteles).
    *   Esto permite respuestas precisas ("¿A qué hora baila la Diablada?") sin alucinaciones.

### 3. Directorio de Servicios (`servicios`)
marketplace para el turismo local.
*   **Motor de Búsqueda**: Filtrado multicriterio (Precio, Ubicación, Calificación) en Javascript (`getFilteredData()`) para respuesta instantánea, con carga inicial de datos via API.
*   **Sistema de Reservas**:
    *   Flow: `Ver Disponibilidad` -> `Seleccionar Fechas` -> `Auth Check` -> `POST /api/reservar.php`.
    *   Validación de doble reserva (Race condition protection en SQL).

### 4. Agenda y Cultura
*   **Simulador**: Algoritmo en Frontend que estima la hora real de presentación basándose en el "promedio de retraso" histórico.

---

## 🗄️ Referencia de Base de Datos

El esquema relacional está normalizado (3NF). Aquí las tablas críticas:

### `users` (Central de Identidad)
| Columna | Tipo | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | Identificador único |
| `email` | VARCHAR(100) | Único, indexado |
| `password` | VARCHAR(255) | Hash Bcrypt (solo si `oauth_provider='email'`) |
| `oauth_provider` | ENUM | 'google', 'facebook', 'email' |
| `oauth_uid` | VARCHAR | ID del proveedor externo |
| `role` | ENUM | 'user', 'admin', 'moderator' |

### `reservaciones` (Transaccional)
| Columna | Tipo | Descripción |
| :--- | :--- | :--- |
| `id` | INT (PK) | ID Reserva |
| `cliente_id` | INT (FK) | Referencia a `clientes.id` |
| `hospedaje_id` | INT (FK) | Referencia a `hospedajes.id` |
| `habitacion_id` | INT (FK) | Referencia a `habitaciones.id` |
| `fecha_entrada` | DATE | Check-in |
| `fecha_salida` | DATE | Check-out |
| `estado` | ENUM | 'pendiente', 'confirmada', 'cancelada' |
| `precio_total` | DECIMAL | Monto final calculado |

### `calificaciones` (Feedback)
| Columna | Tipo | Descripción |
| :--- | :--- | :--- |
| `hospedaje_id` | INT (FK) | Servicio calificado |
| `cliente_id` | INT (FK) | Autor de la reseña |
| `estrellas` | INT | 1-5 |
| `comentario` | TEXT | Opinión opcional |

---

## 🔌 Documentación de API

Todas las respuestas son JSON. Errores siguen formato `{ "message": "Error desc", "success": false }`.

### API Autenticación

#### `POST /api/auth_email.php`
Registra o loguea un usuario con credenciales locales.

**Payload (Login):**
```json
{
  "action": "login",
  "email": "juan@example.com",
  "password": "secret_password"
}
```

**Payload (Register):**
```json
{
  "action": "register",
  "name": "Juan Perez",
  "email": "juan@example.com",
  "password": "secret_password"
}
```

**Respuesta Exitosa:**
```json
{
  "success": true,
  "message": "Inicio de sesión exitoso",
  "user": {
    "id": 15,
    "name": "Juan Perez",
    "email": "juan@example.com",
    "picture": "https://ui-avatars.com/..."
  }
}
```

### API Clientes y Reservas

#### `POST /api/reservar.php`
Crea una nueva reserva. Requiere Token Bearer.

**Headers:**
`Authorization: Bearer <base64_token>`

**Payload:**
```json
{
  "hospedaje_id": 5,
  "habitacion_id": 12,
  "fecha_entrada": "2026-02-02",
  "fecha_salida": "2026-02-05",
  "num_huespedes": 2,
  "notas": "Llegada tarde"
}
```

### API Servicios

#### `GET /api/disponibilidad.php`
Verifica disponibilidad de habitaciones.

**Query Params:**
`?hospedaje_id=5&fecha_entrada=2026-02-02&fecha_salida=2026-02-05`

**Respuesta:**
```json
{
  "hospedaje_id": 5,
  "habitaciones": [
    {
      "id": 12,
      "nombre": "Habitación Doble",
      "precio_noche": 150.00,
      "disponibles": 3,
      "precio_total": 450.00
    }
  ]
}
```

---

## 🧠 Guía de Clases Backend

### `ActivityLogger` (`includes/ActivityLogger.php`)
Sistema de auditoría para seguridad y analítica.
*   **log($userId, $action, $desc, $meta)**: Registra un evento. Captura automáticamente IP y User Agent.
*   **getActivity($userId)**: Retorna historial reciente.

### `EmailService` (`includes/EmailService.php`)
Wrapper para envío de correos transaccionales.
*   En **Desarrollo** (`localhost`), escribe logs en `/logs/emails.log` en lugar de enviar.
*   En **Producción**, usa `mail()` de PHP (configurar SMTP en php.ini para mejor entregabilidad).
*   Métodos: `sendWelcome`, `sendPasswordReset`, `sendEmailVerification`.

### `GroqService` (`chatbot/api/GroqService.php`)
Cliente HTTP para IA.
*   Maneja timeouts y reintentos.
*   Implementa `buildSystemPrompt()` para inyectar la personalidad "festiva" del bot.

---

## 💻 Frontend y Assets

### Vanilla JS Modules
El código JS se organiza por funcionalidad para evitar bundles gigantes.
*   `script.js` (Global): Maneja el contador regresivo, navbar sticky y scroll effects.
*   `live-platform/script.js`: Maneja el player de video y la lógica de sockets simulados.
*   `chatbot/script.js`: Maneja el canvas de video y la UI del chat flotante.

### Estilos (Tailwind)
La configuración de colores se extiende en `tailwind.config` dentro del HTML (modo JIT CDN):
*   `candelaria-purple`: `#4c1d95` (Identidad visual)
*   `candelaria-gold`: `#fbbf24` (Acentos premium)

---

## 🛡️ Seguridad y Rendimiento

1.  **Protección SQL Injection**: Uso estricto de `PDO Adventure` y `Prepared Statements` en todas las consultas.
2.  **XSS Protection**: Inputs sanitizados con `htmlspecialchars` antes de renderizar en el chat o reseñas.
3.  **Session Hijacking**: Regeneración de ID de sesión al login. Cookies `HttpOnly`.
4.  **Rate Limiting**: (Implementado a nivel de servidor web) para endpoints de login.
5.  **Passwords**: Hashed con `PASSWORD_DEFAULT` (Bcrypt).

---

## 🚀 Guía de Instalación y Despliegue

Sigue estos pasos para desplegar el proyecto desde cero en un entorno Linux (Ubuntu/Debian).

### 1. Preparación del Entorno
```bash
# Actualizar sistema
sudo apt update && sudo apt upgrade -y

# Instalar pila LAMP
sudo apt install apache2 mysql-server php8.2 php8.2-mysql php8.2-curl php8.2-gd php8.2-xml libapache2-mod-php8.2 -y

# Habilitar mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 2. Configuración de Base de Datos
```bash
# Entrar a MySQL
sudo mysql

# Crear DB y Usuario
CREATE DATABASE mipuno_candelaria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'candelaria_user'@'localhost' IDENTIFIED BY 'tu_contraseña_segura';
GRANT ALL PRIVILEGES ON mipuno_candelaria.* TO 'candelaria_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Importar Esquema
mysql -u candelaria_user -p mipuno_candelaria < database/EJECUTAR_ESTO.sql
```

### 3. Despliegue de Código
```bash
# Clonar repo (o copiar archivos) a /var/www/html/candelaria
cd /var/www/html
git clone https://github.com/tu-repo/candelaria.git

# Ajustar permisos
sudo chown -R www-data:www-data /var/www/html/candelaria
sudo chmod -R 755 /var/www/html/candelaria
sudo chmod -R 777 /var/www/html/candelaria/assets/uploads # Permiso de escritura
```

### 4. Configuración de Credenciales
Edita `src/Config/Database.php`:
```php
private $host = 'localhost';
private $user = 'candelaria_user';
private $password = 'tu_contraseña_segura';
```

Edita `includes/auth_config.php` con tus API Keys reales.

### 5. Configuración Apache
Asegúrate de que `AllowOverride All` esté configurado para el directorio web para permitir `.htaccess`.

---

## ❓ Troubleshooting

### Error: "Database connection failed"
*   Verifica `src/Config/Database.php`.
*   Asegúrate de que el servicio MySQL esté corriendo: `sudo systemctl status mysql`.
*   Verifica permisos de usuario de DB.

### Error: Chatbot no responde
*   Verifica logs de PHP/Apache: `/var/log/apache2/error.log`.
*   Confirma que la `GROQ_API_KEY` en `config.php` sea válida y tenga crédito.
*   Revisa la consola del navegador para errores JS.

### Error: Mapa no carga puntitos
*   Verifica la consola de red (F12 -> Network). ¿`api/admin/mapa.php` devuelve 200 OK?
*   Si devuelve 404, revisa la ruta relativa en `script.js`.

---

*Documentación generada automáticamente por el equipo de desarrollo de Candelaria 2026. Última actualización: Enero 2026.*
