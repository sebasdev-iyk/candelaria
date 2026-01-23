# Instrucciones del Video Avatar 📹

El chatbot ahora utiliza una tecnología avanzada de **Canvas Chroma Key** para procesar el video en tiempo real.

## ✅ ¿Qué video necesito?

1. **Formato**: WebM (recomendado) o MP4.
2. **Fondo**: **BLANCO SÓLIDO (#FFFFFF)**.
   - El sistema eliminará automáticamente el color blanco.
   - No necesitas editar el video con transparencia en programas externos.
   - Si tu video tiene fondo blanco, funcionará directo.

## 📂 ¿Dónde lo pongo?

Guarda tu archivo exactamente aquí:
`c:\xampp\htdocs\candelaria\chatbot\assets\chatbot-avatar.webm`

## ⚙️ Ajustes Avanzados

Si notas que partes de tu personaje se vuelven transparentes o el fondo no se borra bien, puedes ajustar la sensibilidad.

1. Abre `chatbot/script.js`
2. Busca la función `initVideoCanvas`
3. Encuentra esta línea:
   ```javascript
   const tolerance = { r: 200, g: 200, b: 200 };
   ```

### Guía de Ajuste:
- **Si el fondo NO se borra**: BAJA los números (ej. 180, 180, 180).
- **Si el personaje se ve transparente**: SUBE los números (ej. 230, 230, 230).

---

> [!TIP]
> **Mejor resultado**: Usa un video con buena iluminación y fondo blanco puro. Evita que el personaje vista ropa muy blanca, o podría volverse transparente también.
