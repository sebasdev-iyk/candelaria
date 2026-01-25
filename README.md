# 📘 Documentación Técnica Maestra - Candelaria 2026

**Versión del Documento:** 2.0 (Análisis Profundo de Código)
**Fecha de Generación:** Enero 2026
**Tecnología Base:** PHP 8+, MySQL 8, Supabase Auth, Leaflet JS.

---

## 1. 🔐 Autenticación y Seguridad (Deep Dive)

El sistema de identidad es **híbrido y asincrónico**, operando con dos fuentes de verdad distintas que sirven a propósitos diferentes.

### A. Sistema Moderno (Supabase - Auth 2.0)
Este es el sistema "oficial" para las nuevas interacciones en tiempo real.

*   **Middleware (`includes/supabase-middleware.php`)**:
    *   No confía ciegamente en el frontend. Valida el JWT contra la API de Supabase (`/auth/v1/user`).
    *   **Extracción del Token**: Busca en este orden:
        1.  Cookie: `sb-access-token` (Seteada por `supabase-core.js`).
        2.  Header: `Authorization: Bearer <token>`.
    *   **Respuesta User**: Normaliza el objeto JSON de Supabase devolviendo un array PHP con `id` (UUID), `email`, `name`, `picture`, `provider`.

*   **Uso en Endpoints**:
    *   `api/reservar.php`: Llama a `requireAuth()`. Si el token es inválido o expiro, termina el script con `HTTP 401`.
    *   `api/chat.php`: Usa `validateSupabaseToken()` para asociar el mensaje al UUID del usuario.

### B. Sistema Legacy (MySQL - Sessions)
Remanente de la versión anterior, aún activo para compatibilidad.

*   **Tabla Base de Datos**: `users`
    *   Columnas: `id` (INT, PK), `name`, `email`, `picture`, `oauth_provider`, `oauth_uid`.
*   **API (`api/auth.php`)**:
    *   Recibe un payload JSON `{email, name, picture, provider}`.
    *   **Lógica "Upsert"**: Si el email existe, actualiza el registro (`UPDATE`). Si no, lo crea (`INSERT`).
    *   **Sesión PHP**: Ejecuta `session_start()` y guarda `$_SESSION['user_id']`.
    *   **Debilidad**: La sesión de PHP (`PHPSESSID`) **no** es leída por el middleware de Supabase. Un usuario puede estar logueado en "Legacy" pero no en "Moderno", causando fallos en el chat si los clientes JS no manejan ambos estados.

---

## 2. � Módulo de Danzas y Concurso (Core Logic)

El "corazón" de la información estática del evento.

### Base de Datos (`candela_list`)
Esta tabla es la fuente de la verdad para toda la información de los conjuntos.
*   **Columnas Clave**: `id`, `conjunto` (Nombre), `categoria` (Ej: 'Traje de Luces'), `dia_concurso`, `dia_veneracion`, `orden_concurso` (INT), `orden_veneracion` (INT), `descripcion`, `historia`.

### API (`api/danzas.php`)
*   **Endpoint**: `GET /api/danzas.php`
*   **Parámetros**:
    *   `q`: Búsqueda de texto (LIKE) en nombre, categoría o descripción.
    *   `category`: Filtro exacto por columna `categoria`.
    *   `page` / `pageSize`: Paginación offset-based.
*   **Respuesta JSON**:
    ```json
    {
      "data": [ ... array de objetos danza ... ],
      "pagination": {
        "page": 1,
        "total": 150,
        "totalPages": 15
      }
    }
    ```

---

## 3. 📍 Mapa GPS en Tiempo Real (backend Logic)

El sistema de tracking NO es un simple "pasamanos" de coordenadas. El backend **simula** y **calcula** el movimiento.

### Arquitectura de Simulación (`php-admin/api/admin/mapa.php`)
A diferencia de sistemas GPS reales que reciben lat/lng de dispositivos, este sistema **simula el avance** para garantizar un espectáculo visual fluido incluso si la señal falla.

1.  **Tablas Involucradas**:
    *   `candela_route_points`: Puntos lat/lng que definen el polígono de la ruta oficial (ordenados por `number`).
    *   `candela_route_distances`: Segmentos precalculados con distancia en KM.
    *   `candela_map_dances`: Estado actual de cada conjunto en el mapa.

2.  **Motor de Física en PHP**:
    *   El endpoint `GET /dances` se comporta como un "Game Loop".
    *   **Cálculo de Delta Tiempo**: `elapsed = microtime(true) - last_update_time`.
    *   **Velocidad**: Constante definida `$SPEED_KM_H = 1.6` (aprox. velocidad de desfile).
    *   **Avance**: `distancia_nueva = distancia_actual + (elapsed * velocidad)`.
    *   **Interpolación Lineal**:
        *   El backend busca en qué segmento de la ruta cae la `distancia_nueva`.
        *   Calcula el ratio dentro del segmento (0.0 a 1.0).
        *   Calcula `lat` y `lng` exactos usando la fórmula de la recta entre el inicio y fin del segmento.
    *   **Persistencia**: Actualiza la DB con la nueva `lat`, `lng`, `distance_traveled` y `last_update_time` antes de responder al cliente.

    > **Efecto**: Cada vez que un usuario consulta el mapa, el backend "mueve" a todos los conjuntos un poquito hacia adelante.

3.  **Sincronización (`/sync-dances`)**:
    *   Copia los conjuntos desde `candela_list` a `candela_map_dances`.
    *   Asigna colores e íconos automáticamente según palabras clave en la categoría (Ej: "autoctono" -> 🟢/🕺, "luces" -> 🟣/✨).

---

## 4. 🏨 Servicios Turísticos (Directory SPA)

El módulo `servicios/` opera como un directorio de alto rendimiento.

### Modelo de Datos Unificado
Aunque existen 4 tablas (`hospedajes`, `candela_comida`, `transporte`, `turismo`), el frontend (`servicios/index.php`) las normaliza en una estructura común en memoria llamada `DB`.

#### API Endpoints
*   **Hospedajes (`api/hospedaje.php`)**:
    *   Retorna listado con `servicios` (JSON Array: wifi, tv) e `imagenes` (JSON Array).
    *   Subquery SQL: Calcula `total_reviews` contando filas en la tabla `calificaciones`.
*   **Gastronomía (`api/comida.php`)**: Retorna tabla `candela_comida`.
*   **Transporte (`api/transporte.php`)**: Retorna tabla `transporte`.
*   **Turismo (`api/turismo.php`)**: Retorna tabla `turismo`.

### Lógica Frontend vs Backend
*   **Backend**: Tonto. Simplemente vuelca toda la tabla (`SELECT *`).
*   **Frontend**: Inteligente.
    *   Descarga **todo** al inicio (`Promise.all`).
    *   **Filtrado Local**: La búsqueda por texto, precio y calificación se hace en JavaScript (`Array.filter`), no en SQL. Esto permite respuesta instantánea (<10ms) al escribir en el buscador.

---

## 5. 💬 Chat de Ultra-Baja Latencia (File Based)

Diseñado para soportar miles de usuarios concurrentes sin tumbar la base de datos SQL.

### Arquitectura "Flat-File"
*   **Almacenamiento**: `live-platform/data/chat_messages.json`.
    *   Estructura: `{ "stream_default": [ {id: 1, msg: "Hola", user: "Juan"}, ... ] }`.
*   **Escritura (`POST api/chat.php`)**:
    *   Valida Token Supabase.
    *   Bloquea el archivo (flock), lee el JSON entero, añade el mensaje, trunca el array a los últimos 100 mensajes (buffer circular soft), y guarda.
*   **Lectura (`GET api/chat.php`)**:
    *   Recibe parámetro `last_id`.
    *   Devuelve solo los mensajes con `id > last_id`.
    *   Esta operación es O(1) en disco (lectura secuencial pequeña) vs O(log N) en MySQL.

### Viewer Count (Heartbeat)
*   Archivo: `live-platform/data/viewers.json`.
*   Lógica:
    *   Genera ID único de espectador: `md5(IP + UserAgent)`.
    *   Guardar Timestamp actual en el array del stream.
    *   **Garbage Collection**: Elimina IDs con timestamp > 30 segundos de antigüedad.
    *   Responde con `count(ids)`.

---

## 6. 🏆 Sistema de Puntajes (`puntajes.php`)

Consumo directo de datos públicos.

*   **API**: Reutiliza `api/danzas.php`.
*   **Lógica**:
    *   El campo `puntaje_estadio` y `puntaje_parada` vienen de la DB.
    *   **Cálculo en Cliente**: `Total = parseFloat(estadio) + parseFloat(parada)`.
    *   **Ranking**: `Array.sort((a,b) => b.total - a.total)`.
    *   **Medallas**: Asignación visual por índice `[0]=Oro`, `[1]=Plata`, `[2]=Bronce`.

---

## 7. 🤖 Chatbot Grok (Video Avatar)

Un experimento de interfaz de usuario avanzada.

### Motor Chroma Key (JS)
Archivo: `chatbot/script.js`
1.  **Canvas Doble**: Usa un canvas oculto (`triggerCanvas`) para procesar y un canvas visible (`mainCanvas`) para renderizar.
2.  **Pipeline de Renderizado**:
    *   `ctx.drawImage(video)`: Pinta el frame actual.
    *   `ctx.getImageData()`: Obtiene el buffer de píxeles `Uint8ClampedArray`.
    *   **Loop de Píxeles**:
        ```javascript
        if (r < 40 && g < 40 && b < 40) { // Si es negro oscuro
             alpha = 0; // Transparente
        }
        ```
    *   `ctx.putImageData()`: Vuelca los píxeles modificados.
3.  **Interacción**:
    *   Envía el mensaje del usuario a `chatbot/api/chat.php` (Proxy a LLM).
    *   Muestra respuesta en burbujas de chat HTML sobrepuestas al video.

---

## 8. 🏨 Motor de Reservas (Transaccional)

El único componente con lógica de negocio compleja y validaciones estrictas.

### API (`POST api/reservar.php`)
1.  **Validación de Identidad**: Exige `requireAuth()` (Supabase).
2.  **Validación de Disponibilidad (Critical Section)**:
    *   Verifica si `habitaciones.activo = TRUE`.
    *   **Concurrencia**: Realiza un `COUNT(*)` en la tabla `reservaciones` buscando solapamientos de fecha para esa habitación.
    *   `WHERE estado IN ('pendiente', 'confirmada') AND (fecha_entrada < NEW_OUT AND fecha_salida > NEW_IN)`.
    *   Si `count >= capacidad_habitacion`, lanza error `409 Conflict`.
3.  **Persistencia**:
    *   Inserta la reserva con `user_id` (UUID de Supabase).
    *   Estado inicial: `pendiente`.
    *   Guarda una "foto" del precio en ese momento (`precio_total`).

---

## 📝 Resumen de Tablas SQL Críticas

| Tabla | Uso Principal | Notas |
|-------|---------------|-------|
| `users` | Auth Legacy | Puede quedar obsoleta. |
| `candela_list` | Info Danzas | Fuente maestra del concurso. |
| `candela_route_points` | Mapa | Define la línea verde del recorrido. |
| `candela_route_distances` | Mapa | Pre-cálculo de distancias para interpolación rápida. |
| `candela_map_dances` | Mapa | "Cache" de estado dinámico (lat/lng actual). |
| `hospedajes` | Servicios | Directorio de hoteles . |
| `habitaciones` | Servicios | Inventario de cuartos por hotel. |
| `reservaciones` | Transaccional | Vincula User UUID <-> Habitación ID. |
