# Documentación Interna del Chatbot Candelaria: Guía de Preguntas y Respuestas

Este documento explica en profundidad cómo funciona el "cerebro" del chatbot, cómo decide qué responder y qué tipo de preguntas es capaz de contestar correctamente.

## 🧠 ¿Cómo funciona el Chatbot por dentro?

El chatbot no "piensa" como un humano, sino que sigue un proceso lógico estricto de 3 pasos:

### 1. Detección de Intención (El primer filtro)
Cuando envías un mensaje, el sistema busca palabras clave específicas para entender de qué estás hablando. Si no encuentra estas palabras, asume que es una pregunta general.

| Tema | Palabras Clave que busca el sistema |
| :--- | :--- |
| **Danzas** | `danza`, `baile`, `conjunto`, `morenada`, `diablada`, `caporales`, `tinku`, `saya`, `sikuri`, `carnaval`... |
| **Eventos** | `evento`, `programación`, `horario`, `cuándo`, `fecha`, `día` |
| **Servicios** | `hotel`, `hospedaje`, `restaurante`, `comida`, `transporte`, `bus` |
| **Turismo** | `turismo`, `visitar`, `lago`, `isla`, `sillustani` |

> ⚠️ **Importante:** Antes de mi última actualización, si preguntabas *"¿qué morenadas hay?"*, el sistema **NO** detectaba que hablabas de danzas porque solo buscaba la palabra "danza". Ahora ya reconoce nombres de danzas específicas.

### 2. Búsqueda en la Base de Datos (Extracción de Datos)
Una vez que sabe el tema (ej. Danzas), el sistema busca información en la base de datos `candela_list`.
Aquí es donde ocurre la "magia" o el error:

*   **Antes:** Buscaba la frase exacta. Si preguntabas *"a que hora sale la diablada bellavista"*, buscaba literalmente esa frase larga y no encontraba nada.
*   **Ahora:** El sistema es inteligente. Elimina palabras de relleno (*a, que, hora, sale, la*) y se queda con lo importante: **"diablada bellavista"**. Luego busca coincidencia de AMBAS palabras o al menos UNA.

### 3. Generación de Respuesta (Inteligencia Artificial)
Toda la información encontrada se le envía a **Groq (Llama 3.3)**, una inteligencia artificial potente.
*   Se le dice: *"El usuario preguntó X. Aquí tienes los datos de la base de datos: [Datos de Diablada Bellavista]. Responde amablemente."*
*   Si la base de datos no devolvió nada, la IA inventa una respuesta genérica o dice "no sé". **Por eso es crítico que el paso 2 funcione bien.**

---

## ✅ Preguntas que SÍ puede responder (y por qué)

Con la nueva actualización, el chatbot es capaz de responder preguntas complejas porque extraemos **todos** los detalles técnicos de la base de datos:

1.  **Danzas Específicas:**
    *   *"¿Cuándo baila la Diablada Bellavista?"*
    *   *"Dime la historia de la Morenada Orkapata"*
    *   *"¿Qué número de orden tiene la Caporales Centralistas?"*
    *   **Por qué funciona:** Porque buscamos por nombre y le pasamos a la IA los campos `dia_concurso`, `orden_concurso` y `descripcion` completa.

2.  **Grupos de Danzas:**
    *   *"¿Qué morenadas participan?"*
    *   *"Muestrame las diabladas"*
    *   **Por qué funciona:** Porque la palabra "morenada" activa la búsqueda y trae los primeros 8 resultados que coincidan con "morenada".

3.  **Detalles Técnicos:**
    *   *"¿Qué bandas acompañan a la Diablada Bellavista?"*
    *   *"¿Cuál fue el puntaje de la Morenada Laykakota?"*
    *   **Por qué funciona:** Porque ahora incluimos los campos `bandas`, `puntaje_estadio` y `puntaje_parada` en el contexto.

---

## ❌ Preguntas que NO puede responder (Limitaciones)

1.  **Preguntas subjetivas o de opinión:**
    *   *"¿Cuál es la mejor danza?"*
    *   *"¿Qué banda toca mejor?"*
    *   **Razón:** La base de datos solo tiene datos fríos no opiniones.

2.  **Datos que no están en la tabla:**
    *   *"¿Cómo se llama el presidente de la Diablada X?"* (A menos que esté en el campo `junta_directiva`)
    *   *"¿De qué color es el traje este año?"*
    *   **Razón:** El chatbot solo sabe lo que está en la tabla `candela_list`. Si el dato no se cargó, no lo puede inventar (o no debería).

3.  **Preguntas sobre eventos pasados no registrados:**
    *   *"¿Quién ganó el año 1995?"*
    *   **Razón:** La base de datos actual parece estar centrada en el evento 2026.

---

## 🛠 Guía de Solución de Problemas

Si el chatbot dice "No tengo información sobre X":

1.  **Verifica la ortografía:** Aunque el sistema es flexible, "Diablada Veyavista" podría no coincidir con "Bellavista".
2.  **Verifica que la danza existe en la BD:** Usa el buscador interno del sitio web. Si no sale ahí, el chatbot tampoco lo sabrá.
3.  **Simplifica la pregunta:** En lugar de *"Podrías por favor decirme a qué hora exacta se presenta el conjunto..."*, intenta *"Horario Diablada Bellavista"*. (Aunque la nueva actualización ya maneja frases largas mejor).
