# Documentación Técnica Profunda: Buscador y Listado de Danzas

Este documento disecciona "de extremo a extremo" el flujo de datos, desde que el dedo del usuario toca una tecla hasta que aparece la imagen en pantalla. Incluye un análisis crítico de rendimiento y cuellos de botella ("bottlenecks"), considerando que la base de datos está alojada remotamente.

---

## 1. Arquitectura de Despliegue (Contexto)

Según `deploy.md`, el sistema opera en un entorno distribuido (o simulado como tal por la estructura de carpetas `candelaria` vs `candelaria-admin`):

*   **Frontend**: Navegador del Usuario (Cliente).
*   **Servidor Web**: Ejecuta PHP en `/var/www/html/php-candelaria/candelaria` (Plesk).
*   **Base de Datos**: `mipuno_candelaria` (Ubicada "en otro sitio", externa al servidor web).

```mermaid
graph TD
    A[Usuario (Navegador)] <-->|HTTPS (Internet)| B[Servidor Web (Plesk/PHP)];
    B <-->|TCP/IP (Latencia de Red)| C[Servidor Base de Datos (MySQL)];
```

---

## 2. Flujo de Datos Detallado (Paso a Paso)

Aquí es donde ocurre la magia (y la demora). Analicemos qué pasa exactamente cuando un usuario busca "Diablada".

### Fase 1: El Navegador (Frontend)

1.  **Evento `Input`**: El usuario escribe "D".
2.  **Debounce (La Espera)**:
    *   El código JS en `index.php` tiene una función `debounce` configurada a **300ms**.
    *   *Acción*: El navegador "congela" la petición. Si el usuario escribe "i" antes de que pasen 300ms, el temporizador se reinicia.
    *   *Impacto*: Si el usuario escribe rápido "Diablada", solo se envía 1 petición al final. Si escribe lento "D... i... a...", se envían 3 peticiones distintas.
3.  **La Petición (Request)**:
    *   JS ejecuta `fetch('./api/danzas.php?q=Diablada&page=1')`.
    *   El navegador abre una conexión HTTPS hacia el servidor web.

### Fase 2: El Servidor Web (PHP Processing)

4.  **Inicialización de PHP**:
    *   El servidor recibe la petición y arranca el intérprete de PHP para `api/danzas.php`.
5.  **Conexión a Base de Datos (`Database.php`)**:
    *   **PUNTO CRÍTICO**: Se ejecuta `$database = new Database(); $db = $database->connect(...)`.
    *   El código usa `new PDO(...)` **sin persistencia**.
    *   *Consecuencia*: PHP debe abrir un socket TCP nuevo hacia el Servidor de Base de Datos remoto, realizar el "handshake" (saludo), autenticarse con usuario/password y establecer sesión.
    *   *Demora estimada*: 50ms - 200ms (dependiendo de la distancia al servidor DB).

### Fase 3: La Base de Datos (SQL Execution)

6.  **Consulta 1: El Conteo (`COUNT`)**:
    *   PHP envía: `SELECT COUNT(*) FROM candela_list WHERE (conjunto LIKE '%Diablada%' OR categoria LIKE '%Diablada%' OR descripcion LIKE '%Diablada%')`.
    *   **CUELLO DE BOTELLA**: El uso de `%Diablada%` (comodín al inicio) **imposibilita el uso de índices**.
    *   *Acción*: La base de datos debe leer **TODAS** las filas de la tabla (Full Table Scan), leer todo el texto de la columna `descripcion` (que es `TEXT` y pesada) y comparar.
    *   La DB retorna: `15`.

7.  **Consulta 2: Los Datos (`SELECT`)**:
    *   PHP envía: `SELECT * FROM candela_list WHERE (...) ORDER BY orden_concurso LIMIT 12 OFFSET 0`.
    *   **CUELLO DE BOTELLA**: La base de datos tiene que volver a hacer **OTRO Full Table Scan** con las mismas condiciones pesadas para encontrar las filas, ordenarlas y devolverlas.
    *   La DB retorna: Las 12 filas de datos.

### Fase 4: Respuesta y Renderizado

8.  **Cierre de Conexión**: PHP cierra la conexión a la DB (se pierde el esfuerzo de conexión del paso 5).
9.  **Envío JSON**: PHP convierte el array a JSON y lo envía al navegador.
10. **Pintado en Pantalla**:
    *   JS recibe el JSON.
    *   Elimina el contenido de `#danzas-grid`.
    *   Inyecta el nuevo HTML.
    *   El navegador descarga las imágenes nuevas (otra demora de red, pero paralela).

---

## 3. Análisis Forense: ¿Por qué demora el buscador?

Aquí están los culpables exactos de la lentitud, ordenados por gravedad:

### A. "Full Table Scan" en Campos TEXT (El Asesino Silencioso)
*   **Código**: `descripcion LIKE '%...%'`.
*   **Problema**: La columna `descripcion` es de tipo `TEXT`. Buscar una palabra dentro de párrafos largos de texto comparando letra por letra en cada fila es la operación más lenta que puede hacer una base de datos.
*   **Agravante**: Se hace **dos veces** por búsqueda (una para contar el total y otra para traer los datos).

### B. Latencia de Red "Ping-Pong" (El costo de la DB remota)
*   Si la DB está "en otro sitio", la "distancia" (latencia) se paga **varias veces** por una sola búsqueda:
    1.  Ida y vuelta para conectar (Handshake).
    2.  Ida y vuelta para `SELECT COUNT`.
    3.  Ida y vuelta para `SELECT *`.
*   Si el ping entre Web y DB es de 50ms, solo en "viajes" ya perdiste **150ms**, sin contar el tiempo que le toma a la DB pensar.

### C. Falta de Conexión Persistente
*   En `src/Config/Database.php`, la conexión se crea desde cero en cada petición.
*   En bases de datos remotas, el proceso de autenticación es costoso. No se está reusando la conexión abierta previamente.

### D. Índices Inutilizados
*   Aunque la tabla tenga índices, el operador `LIKE '%texto%'` (con porcentaje al inicio) los ignora. MySQL no puede usar un índice alfabético si no sabe cómo empieza la palabra.

---

## 4. Resumen de Tiempos (Estimado)

| Acción | Local (Ideal) | Remoto (Tu caso) | Causa |
| :--- | :--- | :--- | :--- |
| **Conexión DB** | 2ms | **150ms** | Handshake TCP remoto sin persistencia |
| **Query Count** | 5ms | **200ms+** | Full scan en campo TEXT pesado |
| **Query Datos** | 5ms | **200ms+** | Segundo Full scan redundante |
| **Transferencia** | 1ms | **50ms** | Descarga de JSON (texto grande) |
| **TOTAL** | **~13ms** | **~600ms+** | **Latencia X (Full Scan x 2)** |

> **Conclusión**: El usuario siente lentitud porque el sistema viaja 3 veces al servidor remoto y revisa toda la biblioteca de libros (descripciones) página por página, dos veces, para cada letra que busca.
