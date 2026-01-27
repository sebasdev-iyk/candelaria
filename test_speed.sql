-- =============================================
-- SCRIPT DE PRUEBA DE RENDIMIENTO (BENCHMARK)
-- =============================================
-- Instrucciones:
-- 1. Copia y pega este código en la pestaña "SQL" de phpMyAdmin.
-- 2. Ejecuta y mira el tiempo de respuesta (Duration) que reporta phpMyAdmin abajo.
-- =============================================

-- PRUEBA 1: Conteo Simple (Referencia base)
-- Debería ser muy rápido si la DB está sana.
SELECT COUNT(*) as total_registros FROM candela_list;

-- PRUEBA 2: CULPABLE CONFIRMADO (Full Table Scan en TEXT)
-- Esta es la consulta que hace el buscador.
-- Si esto tarda > 0.1s con solo 246 registros, tu servidor DB tiene CPU muy limitado.
SELECT SQL_NO_CACHE COUNT(*) as coincidencias
FROM candela_list 
WHERE (conjunto LIKE '%Morenada%' OR categoria LIKE '%Morenada%' OR descripcion LIKE '%Morenada%');

-- PRUEBA 3: Simulación de Paginación (Carga de Datos)
-- Mide cuánto tarda en ordenar y traer los textos grandes.
SELECT SQL_NO_CACHE * 
FROM candela_list 
WHERE (conjunto LIKE '%Morenada%' OR categoria LIKE '%Morenada%' OR descripcion LIKE '%Morenada%')
ORDER BY orden_concurso ASC, conjunto ASC 
LIMIT 12 OFFSET 0;
