# Solución de Problemas - Chatbot

## ✅ Cambios Realizados

### 1. **Fondo Blanco del Video - SOLUCIONADO**

He actualizado el CSS para manejar videos con fondo blanco:

**Archivo**: `style.css` (líneas 416-429)

```css
.video-avatar video {
    mix-blend-mode: multiply;  /* Hace el blanco transparente */
    filter: contrast(1.3) brightness(1.2) saturate(1.1);
}
```

El modo `multiply` hace que el fondo blanco se vuelva transparente automáticamente.

### 2. **Ruta de API Corregida**

**Archivo**: `script.js` (línea 9)

Cambié de:
```javascript
const API_URL = '../chatbot/api/chat.php';
```

A:
```javascript
const API_URL = 'api/chat.php';
```

### 3. **Video Avatar Actualizado**

**Archivo**: `script.js` (líneas 290-317)

Removí la clase `has-alpha` por defecto para que el modo `multiply` funcione correctamente con fondos blancos.

---

## 🧪 Cómo Probar

### Opción 1: Página de Test

1. Abre tu navegador
2. Ve a: `http://localhost/candelaria/chatbot/test.html`
3. Verás:
   - ✅ Verificación de todos los archivos
   - ✅ Botón para probar la API
   - ✅ Vista previa del video con el fondo blanco transparente
   - ✅ Botón para abrir el chatbot

### Opción 2: Abrir Chatbot Directamente

1. Ve a: `http://localhost/candelaria/chatbot/`
2. O haz click en el botón flotante morado en: `http://localhost/candelaria/`

---

## 🎥 Sobre el Video con Fondo Blanco

El CSS ahora usa `mix-blend-mode: multiply` que:
- ✅ Hace que el blanco (#FFFFFF) sea completamente transparente
- ✅ Mantiene los colores oscuros del chatbot
- ✅ Funciona automáticamente sin necesidad de procesamiento adicional

**Si el fondo blanco aún se ve**, puedes probar estas alternativas:

### Alternativa 1: Modo Darken (más agresivo)

Edita `style.css` línea 416:
```css
mix-blend-mode: darken;  /* En lugar de multiply */
```

### Alternativa 2: Modo Screen (para fondos oscuros en el video)

Si tu video tiene fondo oscuro en lugar de blanco:
```css
mix-blend-mode: screen;
```

---

## 📊 Archivos del Video

Veo que tienes 2 videos en la carpeta `assets/`:
- `chatbot-avatar.webm` (11.6 MB) ← Este se está usando
- `chatbotgg-avatar.webm` (18.6 MB)

Si quieres usar el otro video, cambia en `script.js` línea 292:
```javascript
const videoPath = 'assets/chatbotgg-avatar.webm';
```

---

## 🔍 Verificar que Todo Funciona

### 1. Verificar Apache y MySQL
- Abre XAMPP Control Panel
- Apache debe estar en verde (corriendo)
- MySQL debe estar en verde (corriendo)

### 2. Probar el Chatbot
```
http://localhost/candelaria/chatbot/test.html
```

### 3. Si el chatbot no abre
- Presiona F12 en el navegador
- Ve a la pestaña "Console"
- Busca errores en rojo
- Copia y pégame los errores que veas

---

## 💡 Ajustes Adicionales del Video

Si necesitas ajustar el tamaño o posición del video, edita `style.css`:

```css
.video-avatar {
    bottom: 100px;  /* Distancia desde abajo */
    right: 30px;    /* Distancia desde la derecha */
    width: 200px;   /* Ancho del video */
    height: 250px;  /* Alto del video */
}
```

---

## 📝 Resumen de Archivos Modificados

1. ✅ `chatbot/style.css` - Fondo blanco transparente
2. ✅ `chatbot/script.js` - Ruta de API corregida + manejo de video
3. ✅ `chatbot/test.html` - Nueva página de pruebas

---

**Próximo paso**: Abre `http://localhost/candelaria/chatbot/test.html` y dime qué ves.
