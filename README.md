# Festividad de la Virgen de la Candelaria 2026 - Puno, Perú
## Análisis Técnico Profundo y Evaluación de Rendimiento Extremo a Extremo

## Descripción del Proyecto

Plataforma web integral para la Festividad de la Virgen de la Candelaria 2026 en Puno, Perú. Esta aplicación proporciona información detallada sobre las danzas, horarios, eventos culturales, servicios turísticos y permite la interacción en tiempo real con transmisiones en vivo y un chatbot de IA.

La festividad de la Virgen de la Candelaria es una de las celebraciones religiosas y culturales más importantes de Perú, reconocida como Patrimonio Cultural Inmaterial de la Humanidad por la UNESCO.

## Arquitectura del Sistema

### Estructura de Directorios Completa
```
candelaria/
├── api/                    # Endpoints de la API
│   ├── danzas_all.php      # Datos de todas las danzas
│   ├── danzas.php          # API de danzas con paginación
│   ├── auth.php            # Autenticación
│   ├── chat.php            # Chatbot de IA
│   ├── GroqService.php     # Servicio de IA Groq
│   ├── DatabaseService.php # Servicio de base de datos
│   └── auth/
│       ├── login.php       # Login de usuarios
│       ├── register.php    # Registro de usuarios
│       └── logout.php      # Cierre de sesión
├── assets/                 # Recursos estáticos
│   ├── css/
│   │   ├── sparks.css      # Efectos visuales
│   │   └── [otros estilos]
│   ├── js/
│   │   ├── spark-effect.js # Efectos de partículas
│   │   ├── supabase-core.js # Cliente Supabase
│   │   └── [otros scripts]
│   └── uploads/            # Imágenes subidas
│       ├── danzas/         # Imágenes de danzas
│       ├── avatars/        # Avatares de usuarios
│       └── [otros recursos]
├── chatbot/                # Componente de IA
│   ├── api/
│   │   ├── chat.php        # Endpoint principal
│   │   ├── GroqService.php # Servicio de IA
│   │   └── DatabaseService.php # Servicio de base de datos
│   ├── assets/
│   │   └── chatbot-avatar.webm # Video avatar
│   ├── config/
│   │   └── config.php      # Configuración del chatbot
│   ├── style.css           # Estilos del chatbot
│   ├── script.js           # Lógica del chatbot
│   ├── test.html           # Pruebas del chatbot
│   └── test-simple.html    # Pruebas simples
├── includes/               # Componentes reutilizables
│   ├── auth-header.php     # Cabecera de autenticación
│   ├── auth_config.php     # Configuración de OAuth
│   ├── standard-header.php # Cabecera estándar
│   ├── standard-footer.php # Pie de página estándar
│   └── [otros componentes]
├── src/                    # Código fuente
│   └── Config/
│       └── Database.php    # Configuración de base de datos
├── cultura/                # Contenido cultural
│   └── cultura.php         # Página de cultura
├── servicios/              # Servicios turísticos
│   ├── hospedajes.php      # Hospedajes
│   ├── comida.php          # Gastronomía
│   ├── transporte.php      # Transporte
│   └── turismo.php         # Turismo
├── horarios_y_danzas/      # Horarios y danzas
│   └── index.php           # Página de horarios
├── noticias/               # Sección de noticias
│   └── index.php           # Página de noticias
├── live-platform/          # Plataforma en vivo
│   ├── index.php           # Página principal
│   ├── style.css           # Estilos
│   ├── script.js           # Lógica de la plataforma
│   ├── includes/
│   │   └── live-functions.php # Funciones de transmisión
│   └── [otros componentes]
├── curetaje-db/            # Scripts de procesamiento de datos
├── database/               # Scripts de base de datos
├── tienda/                 # Tienda virtual (opcional)
├── logs/                   # Registros del sistema
├── principal/              # Recursos principales
│   ├── candelaria-background.webm # Video de fondo
│   ├── Festividad.webp      # Imagen de título
│   ├── virgencandelariaa.webp # Imagen de la virgen
│   ├── logoc.webp           # Logo
│   └── [otros recursos]
├── Dockerfile              # Configuración de contenedor
├── .gitignore              # Archivos ignorados
├── index.php               # Página principal
├── styles.css              # Estilos generales
├── script.js               # Scripts generales
├── contacto.php            # Formulario de contacto
├── perfil.php              # Perfil de usuario
├── puntajes.php            # Sistema de puntuación
├── forgot_password.php     # Recuperación de contraseña
├── reset_password.php      # Restablecimiento de contraseña
├── privacy.php             # Política de privacidad
├── terms.php               # Términos de servicio
├── info.php                # Información del sistema
├── debug_db.php            # Depuración de base de datos
├── delete-data.php         # Eliminación de datos
├── ver_logs.php            # Visualización de logs
├── auth-test.html          # Pruebas de autenticación
├── pruebachatdanza.php     # Pruebas de chat de danzas
├── Chatbot.md              # Documentación del chatbot
├── database_instructions.md # Instrucciones de base de datos
├── danzas_list.md          # Lista de danzas
├── preguntas.md            # Preguntas frecuentes
├── temp_search.csv         # Búsqueda temporal
└── test_speed.sql          # Pruebas de velocidad SQL
```

## Análisis de Rendimiento Extremo a Extremo

### 1. Carga Inicial (index.php)

**Tiempo estimado de carga: 2-5 segundos**

#### Fases de Carga:
1. **Descarga HTML (0-200ms)**: index.php con ~2166 líneas
2. **Carga de recursos externos (200-800ms)**:
   - Google Fonts Montserrat/Poppins
   - Font Awesome icons
   - Tailwind CSS CDN
   - Lucide icons
   - jsPDF y AutoTable
3. **Carga de recursos locales (100-500ms)**:
   - styles.css
   - script.js
   - assets/css/sparks.css
4. **Video de fondo (500-1500ms)**: candelaria-background.webm (posiblemente pesado)
5. **Inicialización de scripts (100-300ms)**:
   - Countdown timer
   - Particles effect
   - Lucide icons
   - Mobile menu

#### Optimizaciones Identificadas:
- **Video de fondo**: Muy pesado, considerar preload o versión comprimida
- **Fuente de video alternativa**: assets.mixkit.co como fallback
- **CSS en línea**: 1000+ líneas de CSS en línea afectan rendimiento
- **Scripts síncronos**: Carga secuencial de múltiples bibliotecas

### 2. Carga de Danzas (RAM Mode)

**Tiempo estimado: 1-3 segundos para primera carga, 50-200ms para subsiguientes**

#### Proceso:
1. **fetch('./api/danzas_all.php')**: Carga completa de datos
2. **Almacenamiento en RAM**: `RAM_DANZAS = response.json()`
3. **Filtrado local**: `filterAndRender()` en navegador
4. **Paginación en cliente**: `renderCurrentPage()`
5. **Renderizado de grid**: 12 elementos por página

#### Puntos Críticos de Rendimiento:
- **Tamaño de datos**: Carga completa de todas las danzas
- **Renderizado inicial**: 3 skeleton cards mientras carga
- **Filtros dinámicos**: Categoría y búsqueda en tiempo real
- **Imágenes lazy loading**: Carga diferida de imágenes

### 3. Sistema de Autenticación

**Tiempo estimado: 300-800ms para login completo**

#### Flujos de Autenticación:
1. **Google OAuth**: Redirección a Google, callback
2. **Facebook Login**: SDK de Facebook (actualmente removido)
3. **Email/Password**: Validación local + backend sync
4. **Supabase Integration**: Sincronización con backend
5. **LocalStorage sync**: Persistencia de sesión

#### Componentes involucrados:
- `includes/auth-header.php`: UI de autenticación
- `includes/auth_config.php`: Credenciales
- `api/auth.php`: Endpoint de sincronización
- `assets/js/supabase-core.js`: Cliente Supabase

### 4. Chatbot de IA

**Tiempo estimado: 1-4 segundos por respuesta**

#### Pipeline de Procesamiento:
1. **Input validation**: Verificación de longitud y contenido
2. **Context building**: Consulta a base de datos para contexto
3. **AI processing**: Llamada a Groq API (modelo Llama 3.3)
4. **Response formatting**: Formateo y retorno de respuesta
5. **Video processing**: Chroma key en tiempo real (canvas)

#### Componentes críticos:
- `chatbot/api/chat.php`: Endpoint principal
- `chatbot/api/GroqService.php`: Servicio de IA
- `chatbot/api/DatabaseService.php`: Contexto de base de datos
- `chatbot/script.js`: Procesamiento de video canvas
- `chatbot/style.css`: Interfaz de usuario

### 5. Plataforma en Vivo

**Tiempo estimado: 2-6 segundos para carga completa**

#### Componentes de la plataforma:
1. **Video player**: Embebidos de diferentes plataformas
2. **Live indicators**: Contador de espectadores en tiempo real
3. **Mapa interactivo**: Leaflet.js con marcadores en tiempo real
4. **Chat en vivo**: WebSocket o polling para mensajes
5. **Sistema de puntuación**: Actualización en tiempo real

#### Recursos pesados:
- **Leaflet.js**: Biblioteca de mapas (200KB+)
- **Video embeds**: YouTube, Twitch u otros proveedores
- **WebSocket connections**: Para actualizaciones en tiempo real

### 6. Sistema de Puntuación

**Tiempo estimado: 500-1500ms para carga de resultados**

#### Proceso de puntuación:
1. **Carga de datos**: `api/danzas.php` con puntajes
2. **Filtrado por categoría**: Autóctonos vs Trajes de Luces
3. **Ordenamiento**: Por puntaje total descendente
4. **Visualización**: Tabla con medallas y colores

## Análisis de Base de Datos

### Estructura de Tablas

#### Tabla `candela_list` (Principal)
```sql
- id: INT AUTO_INCREMENT PRIMARY KEY
- conjunto: VARCHAR(255) - Nombre del conjunto de danza
- categoria: VARCHAR(100) - Categoría (Autóctonos, Luces Parada)
- descripcion: TEXT - Descripción de la danza
- foto: VARCHAR(255) - Ruta de la imagen
- orden_concurso: INT - Orden en el concurso
- dia_concurso: DATE - Fecha del concurso
- dia_veneracion: DATE - Fecha de veneración
- hora: TIME - Hora de presentación
- detalles: TEXT - Detalles adicionales
- puntaje_estadio: DECIMAL(5,2) - Puntaje en estadio
- puntaje_parada: DECIMAL(5,2) - Puntaje en parada
```

#### Tabla `users` (Autenticación)
```sql
- id: INT AUTO_INCREMENT PRIMARY KEY
- oauth_provider: ENUM('google', 'facebook', 'email')
- oauth_uid: VARCHAR(255) - ID único del proveedor
- first_name, last_name: VARCHAR(100) - Nombres
- email: VARCHAR(100) - Correo electrónico
- picture: VARCHAR(255) - URL de avatar
- locale: VARCHAR(10) - Configuración regional
```

#### Tabla `clientes` (Usuarios registrados)
```sql
- id: INT AUTO_INCREMENT PRIMARY KEY
- nombre: VARCHAR(255)
- email: VARCHAR(255) UNIQUE
- telefono: VARCHAR(50)
- password_hash: VARCHAR(255)
```

### Índices y Optimización
- **Índices primarios** en todas las tablas
- **Índices únicos** en combinaciones oauth_provider + oauth_uid
- **Índices de búsqueda** en campos de texto largo

## Configuración del Servidor

### Docker Configuration
```dockerfile
FROM php:8.2-apache
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql
RUN a2enmod rewrite
EXPOSE 80
```

### PHP Configuration
- **Versión mínima**: PHP 8.2
- **Extensiones requeridas**: PDO, PDO_PGSQL, cURL
- **Configuración de seguridad**: CORS, headers de seguridad

### Base de Datos
- **Motor**: MySQL 5.7+
- **Charset**: utf8mb4_unicode_ci
- **Usuario**: mipuno_candelaria_user
- **Nombre de BD**: mipuno_candelaria

## Análisis de Seguridad

### Autenticación y Autorización
1. **OAuth 2.0**: Google y Facebook (legacy)
2. **Email/password**: Validación de contraseñas
3. **Supabase**: Gestión centralizada de sesiones
4. **JWT tokens**: Para sesiones móviles

### Protección contra ataques
- **SQL Injection**: Uso de prepared statements
- **XSS**: Sanitización de entradas
- **CSRF**: Tokens de sesión
- **Rate limiting**: Limitación de solicitudes

## Optimizaciones Recomendadas

### Frontend
1. **Lazy loading**: Imágenes de danzas
2. **Code splitting**: Separar bundles grandes
3. **Caching**: Service worker para recursos estáticos
4. **Minificación**: CSS/JS en producción
5. **Optimización de video**: Formatos modernos (WebM, AVIF)

### Backend
1. **Caching de API**: Redis o Memcached
2. **Pool de conexiones**: PDO connection pooling
3. **Consultas optimizadas**: Índices adecuados
4. **Compresión GZIP**: Activar en Apache
5. **CDN**: Para recursos estáticos

### Base de Datos
1. **Índices compuestos**: En campos de búsqueda frecuente
2. **Query optimization**: Análisis de consultas lentas
3. **Partitioning**: Para tablas grandes
4. **Replication**: Lectura/escribir split

## Métricas de Rendimiento

### Tiempos de Carga Estimados
- **Primera visita**: 3-6 segundos
- **Visita recurrente**: 1-3 segundos (con cache)
- **API responses**: 100-800ms promedio
- **Chat responses**: 1-4 segundos (depende de IA)
- **Video embeds**: 500-2000ms

### Recursos más pesados
1. **Video de fondo**: 50-100MB (muy pesado)
2. **Bibliotecas JS**: jsPDF + AutoTable (500KB+)
3. **Imágenes de danzas**: 100-500KB cada una
4. **Google Fonts**: 100-200KB

## Monitorización y Logs

### Sistemas de logging
- **PHP errors**: En logs del servidor
- **API logs**: En directorio `/logs/`
- **Chatbot errors**: En `chatbot/logs/`
- **Performance metrics**: Google Analytics 4

### Herramientas de monitoreo
- **Google Analytics 4**: GA-QX9MYN69SZ
- **Server logs**: Apache access/error logs
- **Database logs**: Consultas lentas
- **Frontend errors**: Console logs

## Despliegue y Escalabilidad

### Requisitos de hardware
- **CPU**: 2-4 cores para manejar concurrentes
- **RAM**: 4-8GB para cache y procesos
- **Storage**: SSD para mejor I/O
- **Network**: Alta banda para video streaming

### Estrategias de escalado
1. **Horizontal scaling**: Múltiples instancias detrás de load balancer
2. **Database scaling**: Read replicas para consultas
3. **CDN integration**: Cloudflare o similar
4. **Caching layer**: Redis para sesiones y datos temporales

## Pruebas y Validación

### Tipos de pruebas
1. **Unit tests**: Componentes individuales
2. **Integration tests**: Flujos completos
3. **Load tests**: Rendimiento bajo carga
4. **Security tests**: Vulnerabilidades

### Casos de prueba críticos
- **Carga de 1000+ usuarios simultáneos**
- **Búsqueda de danzas con filtros**
- **Login con diferentes proveedores**
- **Respuestas del chatbot bajo carga**
- **Transmisión en vivo con múltiples viewers**

## Mantenimiento y Actualizaciones

### Tareas regulares
1. **Backup de base de datos**: Diario
2. **Rotación de logs**: Semanal
3. **Actualización de dependencias**: Mensual
4. **Monitoreo de rendimiento**: Continuo

### Versionado
- **Git workflow**: Feature branches + pull requests
- **Release cycle**: Semanal durante evento
- **Rollback procedures**: Automatizado

## Consideraciones Especiales para la Festividad

### Temporada alta (Enero-Febrero 2026)
- **Aumento de tráfico**: 10x normal
- **Actualizaciones en tiempo real**: Puntajes, horarios
- **Soporte multilingüe**: Español, inglés, posiblemente quechua/aymara
- **Accesibilidad**: Cumplimiento WCAG

### Contenido dinámico
- **Horarios actualizados**: Constantemente durante el evento
- **Resultados de competencias**: Actualización en tiempo real
- **Transmisiones en vivo**: Coordinación con equipos de transmisión
- **Noticias y anuncios**: Panel de administración

---

*© 2026 Festividad Virgen de la Candelaria. Todos los derechos reservados.*
*Análisis técnico realizado para optimización de rendimiento extremo a extremo.*