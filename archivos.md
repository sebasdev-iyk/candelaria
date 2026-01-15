# Estructura de Archivos y Funcionamiento de PHP en `candelaria`

Este documento detalla la estructura del directorio `candelaria` (frontend del proyecto) y explica el rol de PHP en esta sección.

## 1. Estructura de Archivos y Carpetas

La carpeta `candelaria` contiene el código fuente de la página web principal de la Festividad.

### Archivos Principales
*   **`index.php`**: Es la página de inicio (Landing Page). Aunque tiene extensión `.php`, su contenido es principalmente HTML5, CSS y JavaScript para mostrar la portada, el contador regresivo y la navegación.
*   **`styles.css`**: Hoja de estilos principal que define la apariencia visual global (colores, fuentes, layout).
*   **`script.js`**: Lógica de JavaScript general para la página principal (animaciones, menú móvil, etc.).
*   **`info.php`**: Archivo utilitario (probablemente `phpinfo()`) para verificar la configuración del servidor.

### Directorios
*   **`api/`**: Contiene scripts PHP que actúan como "micro-servicios" o endpoints para el frontend.
    *   `comida.php`, `danzas.php`, `hospedaje.php`, etc.: Estos archivos consultan la base de datos y devuelven información específica en formato JSON para que el frontend la consuma dinámicamente.
*   **`assets/`**: Almacena recursos estáticos.
    *   `css/`, `js/`: Estilos y scripts específicos (ej. widget del chatbot).
    *   `img/`: Imágenes del sitio.
*   **`cultura/`**: Páginas HTML estáticas dedicadas a la información cultural (Historia, Danzas, Ganadores).
*   **`horarios_y_danzas/`**: Sección con la programación y mapa del evento.
*   **`servicios/`**: Páginas informativas sobre turismo, hospedaje, gastronomía, etc.
*   **`principal/`**: Contiene los recursos multimedia pesados de la portada (videos de fondo, imágenes principales).
*   **`src/Config/`**: Probablemente contiene la configuración de conexión a la base de datos (Clase `Database.php`).

---

## 2. ¿Cómo funciona PHP aquí?

En este proyecto, PHP cumple dos roles fundamentales:

### A. Servidor de Contenido (Vistas)
Archivos como `index.php` utilizan PHP principalmente para ser servidos por el servidor web (Apache/Nginx). Esto permite:
*   **Inclusión de archivos:** Se podría usar `include 'header.php'` para no repetir código (aunque `index.php` es mayormente estático en este caso).
*   **Lógica de Renderizado:** Si fuera necesario, PHP podría decidir qué mostrar antes de enviar el HTML al navegador.

### B. Backend de Datos (API)
La carpeta `api/` es donde está la "inteligencia" del sistema. Así funciona:
1.  **Solicitud:** El JavaScript del navegador (frontend) hace una petición (fetch) a `api/danzas.php`.
2.  **Procesamiento PHP:**
    *   El script PHP se conecta a la Base de Datos (MySQL) usando la configuración de `src/Config/`.
    *   Ejecuta una consulta SQL (ej. `SELECT * FROM danzas`).
    *   Convierte los resultados a formato **JSON**.
3.  **Respuesta:** PHP envía ese JSON al navegador.
4.  **Visualización:** El JavaScript recibe los datos y construye el HTML dinámicamente para mostrar la lista de danzas.

**Ejemplo del Chatbot:**
Cuando preguntas algo al chatbot, la petición va a `../php-admin/api/chatbot.php`. PHP procesa tu texto, busca en la base de datos, consulta a la IA (Gemini) y devuelve la respuesta. El frontend solo se encarga de mostrarla.
