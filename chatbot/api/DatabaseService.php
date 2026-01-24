<?php
/**
 * DatabaseService
 * 
 * Servicio para consultar la base de datos y obtener información relevante
 * para el chatbot. Extrae datos sobre eventos, danzas, ubicaciones, etc.
 */

require_once __DIR__ . '/../config/config.php';

class DatabaseService
{
    private $pdo;

    /**
     * Constructor - Establece conexión con la base de datos
     */
    public function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new Exception(ERROR_DATABASE);
        }
    }

    /**
     * Construye el contexto relevante basado en el mensaje del usuario
     * 
     * @param string $userMessage Mensaje del usuario
     * @return string Contexto formateado para Groq
     */
    public function buildContext($userMessage)
    {
        $context = "INFORMACIÓN DE LA BASE DE DATOS:\n\n";

        // Convertir mensaje a minúsculas para búsqueda
        $messageLower = mb_strtolower($userMessage, 'UTF-8');

        // Detectar intención del usuario
        $isAskingAboutEvents = $this->containsKeywords($messageLower, ['evento', 'programación', 'horario', 'cuándo', 'fecha', 'día']);
        $isAskingAboutDances = $this->containsKeywords($messageLower, ['danza', 'baile', 'conjunto', 'traje']);
        $isAskingAboutLocation = $this->containsKeywords($messageLower, ['dónde', 'ubicación', 'lugar', 'dirección', 'mapa']);
        $isAskingAboutHistory = $this->containsKeywords($messageLower, ['historia', 'origen', 'tradición', 'virgen', 'candelaria', 'cultura']);
        $isAskingAboutServices = $this->containsKeywords($messageLower, ['service', 'hotel', 'hospedaje', 'hostal', 'alojamiento', 'restaurante', 'comida', 'comer', 'cena', 'almuerzo']);
        $isAskingAboutTransport = $this->containsKeywords($messageLower, ['transporte', 'bus', 'taxi', 'movilidad', 'viaje', 'llegar', 'terminal', 'aeropuerto']);
        $isAskingAboutTourism = $this->containsKeywords($messageLower, ['turismo', 'turístico', 'visitar', 'conocer', 'lago', 'isla', 'sillustani', 'chullpas']);
        $isAskingAboutNews = $this->containsKeywords($messageLower, ['noticia', 'nuevo', 'actualidad', 'últimas']);

        // Detectar si se menciona un hotel específico primero
        $specificHotelId = $this->findSpecificHotel($messageLower);
        if ($specificHotelId) {
            $hotelDetails = $this->getHotelDetails($specificHotelId);
            if ($hotelDetails) {
                $context .= "HOTEL ENCONTRADO (COINCIDENCIA EXACTA):\n";
                $context .= $hotelDetails . "\n\n";
            }
        }

        // Obtener información relevante según la intención
        if ($isAskingAboutEvents) {
            $events = $this->getRecentEvents();
            if (!empty($events)) {
                $context .= "EVENTOS Y PROGRAMACIÓN:\n";
                foreach ($events as $event) {
                    $context .= "- {$event}\n";
                }
                $context .= "\n";
            }
        }

        if ($isAskingAboutDances) {
            $dances = $this->searchDances($messageLower);
            if (!empty($dances)) {
                $context .= "DANZAS:\n";
                foreach ($dances as $dance) {
                    $context .= "- {$dance}\n";
                }
                $context .= "\n";
            }
        }

        if ($isAskingAboutServices && !$specificHotelId) { // Solo mostrar generales si no encontramos uno específico
            $services = $this->getServices($messageLower);
            if (!empty($services)) {
                $context .= "SERVICIOS DISPONIBLES:\n";
                foreach ($services as $service) {
                    $context .= "- {$service}\n";
                }
                $context .= "\n";
            }
        }



        if ($isAskingAboutTransport) {
            $transport = $this->getTransport($messageLower);
            if (!empty($transport)) {
                $context .= "OPCIONES DE TRANSPORTE:\n";
                foreach ($transport as $item) {
                    $context .= "- {$item}\n";
                }
                $context .= "\n";
            }
        }

        if ($isAskingAboutTourism) {
            $tourism = $this->getTourism($messageLower);
            if (!empty($tourism)) {
                $context .= "LUGARES TURÍSTICOS:\n";
                foreach ($tourism as $item) {
                    $context .= "- {$item}\n";
                }
                $context .= "\n";
            }
        }

        if ($isAskingAboutNews) {
            $news = $this->getNews();
            if (!empty($news)) {
                $context .= "NOTICIAS RECIENTES:\n";
                foreach ($news as $item) {
                    $context .= "- {$item}\n";
                }
                $context .= "\n";
            }
        }

        if ($isAskingAboutLocation || $isAskingAboutHistory) {
            $context .= $this->getGeneralInfo();
        }

        // Si no encontramos información específica, dar contexto general
        if ($context === "INFORMACIÓN DE LA BASE DE DATOS:\n\n") {
            $context .= $this->getGeneralInfo();
            $context .= $this->getWebsiteInfo();
        }

        return $context;
    }

    /**
     * Verifica si el texto contiene alguna de las palabras clave
     */
    private function containsKeywords($text, $keywords)
    {
        foreach ($keywords as $keyword) {
            if (mb_strpos($text, $keyword, 0, 'UTF-8') !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Busca menciones específicas de hoteles en el mensaje
     */
    private function findSpecificHotel($messageLower)
    {
        try {
            if ($this->tableExists('hospedajes')) {
                // Obtener todos los nombres de hoteles para buscar coincidencias
                $stmt = $this->pdo->query("SELECT id, nombre FROM hospedajes");
                $hotels = $stmt->fetchAll();

                foreach ($hotels as $hotel) {
                    $hotelName = mb_strtolower($hotel['nombre'], 'UTF-8');
                    // Buscar coincidencia exacta del nombre o palabras clave significativas
                    // Simplificado: si el nombre del hotel está en el mensaje
                    if (mb_strpos($messageLower, $hotelName, 0, 'UTF-8') !== false) {
                        return $hotel['id'];
                    }

                    // Opcional: buscar coincidencias parciales si el nombre es largo (ej. "Gran Hotel Puno" -> "Hotel Puno")
                    if (strlen($hotelName) > 10) {
                        $words = explode(' ', $hotelName);
                        $matchCount = 0;
                        foreach ($words as $word) {
                            if (strlen($word) > 3 && mb_strpos($messageLower, $word, 0, 'UTF-8') !== false) {
                                $matchCount++;
                            }
                        }
                        // Si coinciden más de la mitad de las palabras significativas
                        if ($matchCount >= count($words) / 2 && count($words) > 1) {
                            return $hotel['id'];
                        }
                    }
                }
            }
        } catch (PDOException $e) {
            error_log("Error finding specific hotel: " . $e->getMessage());
        }
        return null;
    }

    /**
     * Obtiene eventos recientes o próximos
     */
    private function getRecentEvents()
    {
        $events = [];

        try {
            // Intentar obtener de tabla 'events' o 'programacion'
            $tables = ['events', 'programacion', 'schedule'];

            foreach ($tables as $table) {
                if ($this->tableExists($table)) {
                    $stmt = $this->pdo->query("SELECT * FROM {$table} LIMIT 10");
                    $results = $stmt->fetchAll();

                    foreach ($results as $row) {
                        // Formatear según las columnas disponibles
                        $eventText = $this->formatEvent($row);
                        if ($eventText) {
                            $events[] = $eventText;
                        }
                    }
                    break;
                }
            }
        } catch (PDOException $e) {
            error_log("Error getting events: " . $e->getMessage());
        }

        // Si no hay eventos en BD, dar información general
        if (empty($events)) {
            $events[] = "La Festividad de la Virgen de la Candelaria se celebra del 2 al 18 de febrero de 2026 en Puno, Perú.";
            $events[] = "Día principal: 2 de febrero - Día de la Virgen de la Candelaria";
            $events[] = "Concurso de Danzas Autóctonas: Primera quincena de febrero";
            $events[] = "Concurso de Danzas con Trajes de Luces: Segunda quincena de febrero";
        }

        return $events;
    }

    /**
     * Busca danzas en la base de datos
     */
    private function searchDances($searchTerm = '')
    {
        $dances = [];

        try {
            $tables = ['candela_list'];

            foreach ($tables as $table) {
                if ($this->tableExists($table)) {
                    if ($searchTerm) {
                        $stmt = $this->pdo->prepare("SELECT * FROM {$table} WHERE LOWER(conjunto) LIKE ? OR LOWER(descripcion) LIKE ? OR LOWER(historia) LIKE ? LIMIT 8");
                        $searchPattern = "%{$searchTerm}%";
                        $stmt->execute([$searchPattern, $searchPattern, $searchPattern]);
                    } else {
                        $stmt = $this->pdo->query("SELECT * FROM {$table} ORDER BY conjunto ASC LIMIT 10");
                    }

                    $results = $stmt->fetchAll();

                    foreach ($results as $row) {
                        $danceText = $this->formatDance($row);
                        if ($danceText) {
                            $dances[] = $danceText;
                        }
                    }
                    break;
                }
            }
        } catch (PDOException $e) {
            error_log("Error getting dances: " . $e->getMessage());
        }

        // Si no hay danzas en BD, dar información general
        if (empty($dances)) {
            $dances[] = "Diablada Puneña - Una de las danzas más representativas, con máscaras y trajes elaborados";
            $dances[] = "Morenada - Danza que representa a los esclavos africanos en las minas";
            $dances[] = "Llamerada - Danza que representa a los pastores de llamas del altiplano";
            $dances[] = "Caporales - Danza moderna con movimientos acrobáticos y energéticos";
            $dances[] = "Sicuris - Danza autóctona con música de zampoñas";
        }

        return $dances;
    }

    /**
     * Obtiene información general sobre la festividad
     */
    private function getGeneralInfo()
    {
        return "INFORMACIÓN GENERAL:\n" .
            "La Festividad de la Virgen de la Candelaria es la celebración religiosa y cultural más importante de Puno, Perú.\n" .
            "Declarada Patrimonio Cultural Inmaterial de la Humanidad por la UNESCO en 2014.\n" .
            "Se celebra en honor a la Virgen de la Candelaria, patrona de Puno.\n" .
            "Ubicación: Ciudad de Puno, a orillas del Lago Titicaca, en el altiplano peruano.\n" .
            "Participan más de 40,000 danzarines y 9,000 músicos de diferentes conjuntos.\n" .
            "<a href='horarios_y_danzas/index.php' style='color: #fbbf24; text-decoration: underline;'>Ver programación completa →</a>\n\n";
    }

    /**
     * Verifica si una tabla existe en la base de datos
     */
    private function tableExists($tableName)
    {
        try {
            $result = $this->pdo->query("SHOW TABLES LIKE '{$tableName}'");
            return $result->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Formatea un evento para el contexto
     */
    private function formatEvent($row)
    {
        // Intentar diferentes formatos de columnas
        $name = $row['nombre'] ?? $row['name'] ?? $row['title'] ?? $row['event_name'] ?? null;
        $date = $row['fecha'] ?? $row['date'] ?? $row['event_date'] ?? null;
        $time = $row['hora'] ?? $row['time'] ?? $row['event_time'] ?? null;
        $description = $row['descripcion'] ?? $row['description'] ?? null;

        if (!$name)
            return null;

        $text = $name;
        if ($date)
            $text .= " - {$date}";
        if ($time)
            $text .= " a las {$time}";
        if ($description)
            $text .= ": {$description}";

        return $text;
    }

    /**
     * Formatea una danza para el contexto
     */
    private function formatDance($row)
    {
        $name = $row['conjunto'] ?? $row['nombre'] ?? null;
        $description = $row['descripcion'] ?? $row['historia'] ?? null;
        $category = $row['categoria'] ?? null;

        if (!$name)
            return null;

        $text = "🎭 {$name}";
        if ($category)
            $text .= " ({$category})";

        // Agregar detalles de programación si existen y son relevantes
        $orden = $row['orden_concurso'] ?? null;
        $diaConcurso = $row['dia_concurso'] ?? null;
        $diaVeneracion = $row['dia_veneracion'] ?? null;

        if ($orden)
            $text .= " - Orden: {$orden}";
        if ($diaConcurso)
            $text .= " - Concurso: {$diaConcurso}";
        if ($diaVeneracion)
            $text .= " - Veneración: {$diaVeneracion}";

        if ($description)
            $text .= "\n📝 " . substr(strip_tags($description), 0, 100) . "...";

        return $text;
    }

    /**
     * Obtiene detalles de un hotel específico por ID con enlace directo
     */
    private function getHotelDetails($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM hospedajes WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            if ($row) {
                $name = $row['nombre'];
                $desc = $row['descripcion'] ?? '';
                $price = $row['precio_desde'] ?? $row['precio_noche'] ?? 'Consultar';
                $location = $row['ubicacion'] ?? '';

                $text = "Nombre: {$name}\n";
                if ($location)
                    $text .= "Ubicación: {$location}\n";
                if ($price)
                    $text .= "Precio: desde S/. {$price}\n";
                if ($desc)
                    $text .= "Descripción: " . substr($desc, 0, 150) . "...\n";

                // Enlace directo
                $text .= "🔗 <a href='servicios/Hospedajes/hotel.php?id={$id}' target='_blank' style='color: #fbbf24; text-decoration: underline; font-weight: bold;'>VER DETALLES Y RESERVAR ESTE HOTEL</a>";

                return $text;
            }
        } catch (PDOException $e) {
            error_log("Error getting hotel details: " . $e->getMessage());
        }
        return null;
    }

    /**
     * Obtiene servicios (hospedajes, restaurantes)
     */
    private function getServices($searchTerm = '')
    {
        $services = [];

        try {
            // Buscar hospedajes
            if ($this->tableExists('hospedajes')) {
                // Si buscaron "hotel", mostrar random o destacados.
                // Si buscaron algo más específico y no cayó en findSpecificHotel, intentar búsqueda FULL LIKE

                $query = "SELECT * FROM hospedajes LIMIT 5";

                // OJO: La búsqueda específica ya la hicimos fuera. Aquí mostramos generales.

                $stmt = $this->pdo->query($query);
                $results = $stmt->fetchAll();

                foreach ($results as $row) {
                    $name = $row['nombre'] ?? $row['name'] ?? null;
                    $type = $row['tipo'] ?? 'Hospedaje';
                    $price = $row['precio_desde'] ?? $row['precio_noche'] ?? null;
                    $id = $row['id'] ?? null;

                    if ($name && $id) {
                        $text = "🏨 {$type}: {$name}";
                        if ($price)
                            $text .= " (desde S/. {$price})";
                        // Agregar link clickeable
                        $text .= " - <a href='servicios/Hospedajes/hotel.php?id={$id}' target='_blank' style='color: #fbbf24; text-decoration: underline;'>Ver Hotel</a>";
                        $services[] = $text;
                    }
                }
            }

            // Buscar restaurantes (candela_comida)
            if ($this->tableExists('candela_comida')) {
                $query = "SELECT * FROM candela_comida ";
                if ($searchTerm && mb_strpos($searchTerm, 'comida') === false && mb_strpos($searchTerm, 'restaurante') === false) {
                    // Si hay término específico
                    $query .= "WHERE LOWER(nombre) LIKE '%" . $searchTerm . "%' ";
                }
                $query .= "LIMIT 5";

                $stmt = $this->pdo->query($query);
                $results = $stmt->fetchAll();

                foreach ($results as $row) {
                    $name = $row['nombre'] ?? null;
                    $desc = $row['descripcion'] ?? '';
                    $price = $row['precio_promedio'] ?? null;
                    $location = $row['ubicacion'] ?? '';

                    if ($name) {
                        $text = "🍴 Restaurante: {$name}";
                        if ($price)
                            $text .= " (Promedio: S/. {$price})";
                        if ($location)
                            $text .= " - Ubicación: {$location}";
                        $services[] = $text;
                    }
                }
            }
        } catch (PDOException $e) {
            error_log("Error getting services: " . $e->getMessage());
        }

        // Información general si no hay datos
        if (empty($services)) {
            $services[] = "Visita nuestra <a href='servicios/index.php' style='color: #fbbf24; text-decoration: underline;'>sección de Servicios</a> para ver hospedajes, restaurantes y más.";
            $services[] = "Contamos con opciones de alojamiento desde hostales económicos hasta hoteles de lujo.";
            $services[] = "Restaurantes con comida típica puneña y opciones internacionales.";
        }

        return $services;
    }

    /**
     * Obtiene noticias recientes
     */
    private function getNews()
    {
        $news = [];

        try {
            if ($this->tableExists('noticias')) {
                $stmt = $this->pdo->query("SELECT * FROM noticias ORDER BY fecha DESC LIMIT 5");
                $results = $stmt->fetchAll();

                foreach ($results as $row) {
                    $title = $row['titulo'] ?? $row['title'] ?? null;
                    $date = $row['fecha'] ?? null;
                    $id = $row['id'] ?? null;

                    if ($title) {
                        $text = $title;
                        if ($date)
                            $text .= " ({$date})";
                        if ($id) {
                            $text .= " <a href='noticias/detalle.php?id={$id}' style='color: #fbbf24; text-decoration: underline;'>Leer más →</a>";
                        }
                        $news[] = $text;
                    }
                }
            }
        } catch (PDOException $e) {
            error_log("Error getting news: " . $e->getMessage());
        }

        return $news;
    }

    /**
     * Obtiene opciones de transporte
     */
    private function getTransport($searchTerm = '')
    {
        $transport = [];
        try {
            if ($this->tableExists('transporte')) {
                // Busqueda simple de todo si no hay termino específico relevante, o filtrado si queremos ser más pro (por ahora traemos todo limit 5)
                $query = "SELECT * FROM transporte ORDER BY nombre ASC LIMIT 10";
                $stmt = $this->pdo->query($query);
                $results = $stmt->fetchAll();

                foreach ($results as $row) {
                    $name = $row['empresa'] ?? $row['nombre'] ?? 'Transporte';
                    $type = $row['tipo'] ?? 'General';
                    $route = $row['ruta'] ?? $row['destino'] ?? '';
                    $address = $row['direccion'] ?? '';

                    $text = "🚌 {$name} ({$type})";
                    if ($route)
                        $text .= " - Ruta: {$route}";
                    if ($address)
                        $text .= " - Dirección: {$address}";

                    $transport[] = $text;
                }
            }
        } catch (PDOException $e) {
            error_log("Error getting transport: " . $e->getMessage());
        }

        if (empty($transport)) {
            $transport[] = "Puedes encontrar opciones de transporte en nuestra sección de Servicios > Transporte.";
            $transport[] = "El Terminal Terrestre de Puno conecta con los principales destinos nacionales.";
        }

        return $transport;
    }

    /**
     * Obtiene lugares turísticos
     */
    private function getTourism($searchTerm = '')
    {
        $places = [];
        try {
            if ($this->tableExists('turismo')) {
                $query = "SELECT * FROM turismo ORDER BY nombre ASC LIMIT 8";
                $stmt = $this->pdo->query($query);
                $results = $stmt->fetchAll();

                foreach ($results as $row) {
                    $name = $row['nombre'] ?? $row['lugar'] ?? 'Lugar Turístico';
                    $desc = $row['descripcion'] ?? '';
                    $location = $row['ubicacion'] ?? '';

                    $text = "📸 {$name}";
                    if ($location)
                        $text .= " ({$location})";
                    if ($desc)
                        $text .= ": " . substr($desc, 0, 100) . "...";

                    $places[] = $text;
                }
            }
        } catch (PDOException $e) {
            error_log("Error getting tourism: " . $e->getMessage());
        }

        if (empty($places)) {
            $places[] = "Los Uros: Islas flotantes artificiales hechas de totora.";
            $places[] = "Taquile: Isla conocida por su arte textil patrimonio de la humanidad.";
            $places[] = "Sillustani: Complejo funerario con torres funerarias (chullpas).";
        }

        return $places;
    }

    /**
     * Información sobre el sitio web
     */
    private function getWebsiteInfo()
    {
        return "\nSECCIONES DEL SITIO WEB:\n" .
            "- Inicio: Información general y contador de la festividad\n" .
            "- Servicios: Hospedajes, restaurantes y transporte\n" .
            "- Horarios y Danzas: Programación completa y conjuntos participantes\n" .
            "- Cultura: Historia y tradiciones de la festividad\n" .
            "- Noticias: Últimas actualizaciones y anuncios\n" .
            "- En Vivo: Transmisiones en directo del evento\n\n";
    }

    /**
     * Test de conexión (para debugging)
     */
    public function testConnection()
    {
        try {
            $stmt = $this->pdo->query("SELECT 1");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
