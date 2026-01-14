// Configuración
const MAP_CENTER = [-15.8407, -70.0214]; // Puno
const MAP_ZOOM = 14;
// DETECCIÓN AUTOMÁTICA DE ENTORNO
const API_BASE_URL = window.location.hostname === 'localhost'
    ? '/php-candelaria/php-admin/api/admin/mapa.php'
    : '/candelaria-admin/api/admin/mapa.php';

// Variables globales
let map;
let routeLine = null;
let routePoints = [];
let dansas = [];
let totalRouteLength = 0;
let updateInterval;
let danceMarkers = {};

// Función para establecer pestaña activa (nueva compatibilidad con servicios estilo)
function setActiveTab(tabName) {
    // Actualizar UI de pestañas
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');
        btn.classList.add('border-transparent', 'text-gray-500');
    });

    const activeBtn = document.getElementById(`tab-${tabName}`);
    if (activeBtn) {
        activeBtn.classList.remove('border-transparent', 'text-gray-500');
        activeBtn.classList.add('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');
    }

    // Redirigir a la pestaña correspondiente
    if (tabName !== 'mapa') {
        window.location.href = `../${tabName}/index.html`;
    }
}

// Inicializar mapa
async function initMap() {
    map = L.map('map').setView(MAP_CENTER, MAP_ZOOM);

    // Capa base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Cargar datos iniciales
    await loadRoute();
    await loadDances();

    // Iniciar polling para actualizaciones en tiempo real
    updateInterval = setInterval(updateDancesState, 2000);
}

// Cargar ruta
async function loadRoute() {
    try {
        const response = await fetch(`${API_BASE_URL}/route-points`);
        if (response.ok) {
            routePoints = await response.json();
            drawRoute();
        }

        const lengthResponse = await fetch(`${API_BASE_URL}/route-length`);
        if (lengthResponse.ok) {
            const data = await lengthResponse.json();
            totalRouteLength = data.total_length || 0;
        }
    } catch (error) {
        console.error('Error cargando ruta:', error);
    }
}

// Dibujar ruta en el mapa
function drawRoute() {
    if (routeLine) {
        map.removeLayer(routeLine);
    }

    if (routePoints && routePoints.length >= 2) {
        const latlngs = routePoints.map(p => [p.lat, p.lng]);

        routeLine = L.polyline(latlngs, {
            color: '#4CAF50',
            weight: 6,
            opacity: 0.7,
            smoothFactor: 1,
            lineCap: 'round',
            lineJoin: 'round',
            dashArray: '10, 10'  // Dashed line to make it more visible
        }).addTo(map);

        // Ajustar vista para mostrar toda la ruta
        map.fitBounds(routeLine.getBounds(), { padding: [50, 50] });
    }
}

// Cargar lista de danzas inicial
async function loadDances() {
    try {
        const response = await fetch(`${API_BASE_URL}/dances`);
        if (response.ok) {
            dansas = await response.json();
            renderDancesList();
            updateMapMarkers();
        }
    } catch (error) {
        console.error('Error cargando danzas:', error);
        document.getElementById('dance-list').innerHTML =
            '<div style="text-align: center; padding: 20px; color: #666;">Error al cargar las danzas</div>';
    }
}

// Actualizar estado de las danzas (polling)
async function updateDancesState() {
    try {
        const response = await fetch(`${API_BASE_URL}/dances`);
        if (response.ok) {
            const newDances = await response.json();
            console.log('📊 Dances updated:', newDances);

            // Actualizar datos locales
            dansas = newDances;

            // Actualizar UI y mapa
            updateDancesListUI();
            updateMapMarkers();

            // Actualizar contador
            const activeCount = dansas.filter(d => d.started && !d.finished).length;
            console.log('🏃 Active dances:', activeCount);
            document.getElementById('active-dances-count').textContent = activeCount;

            // Also refresh route length periodically to keep it updated
            const lengthResponse = await fetch(`${API_BASE_URL}/route-length`);
            if (lengthResponse.ok) {
                const data = await lengthResponse.json();
                totalRouteLength = data.total_length || 0;
            }
        } else {
            console.error('❌ Failed to fetch dances:', response.status);
        }
    } catch (error) {
        console.error('❌ Error actualizando estado:', error);
    }
}

// Renderizar lista de danzas en el panel lateral
function renderDancesList() {
    const container = document.getElementById('dance-list');

    if (dansas.length === 0) {
        container.innerHTML = '<div style="text-align: center; padding: 20px; color: #666;">No hay danzas registradas</div>';
        return;
    }

    container.innerHTML = dansas.map(danza => createDanceItemHTML(danza)).join('');
}

// Crear HTML para un item de danza
function createDanceItemHTML(danza) {
    const statusText = danza.finished ? 'Finalizado' :
        danza.started ? 'En recorrido' : 'En espera';

    const statusIcon = danza.finished ? '🏁' :
        danza.started ? '🏃' : '📍';

    const activeClass = danza.started && !danza.finished ? 'active' : '';

    return `
        <div class="dance-item ${activeClass}" id="dance-item-${danza.id}">
            <div class="dance-icon" style="color: ${danza.color}">
                ${danza.icon || '💃'}
            </div>
            <div class="dance-info">
                <h3>${danza.name}</h3>
                <div class="dance-status">
                    <span>${statusIcon}</span> ${statusText}
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: ${Math.min(danza.progress, 100)}%; background: ${danza.color}"></div>
                </div>
                <p class="distance-info">
                    ${danza.distance_traveled.toFixed(1)} km de ${totalRouteLength.toFixed(1)} km
                </p>
            </div>
        </div>
    `;
}

// Actualizar solo los valores cambiantes en la lista
function updateDancesListUI() {
    dansas.forEach(danza => {
        const item = document.getElementById(`dance-item-${danza.id}`);
        if (item) {
            // Actualizar clase active
            if (danza.started && !danza.finished) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }

            // Actualizar barra de progreso
            const progressBar = item.querySelector('.progress-fill');
            if (progressBar) {
                progressBar.style.width = `${Math.min(danza.progress, 100)}%`;
            }

            // Actualizar texto de distancia
            const distanceText = item.querySelector('.distance-info');
            if (distanceText) {
                distanceText.textContent = `${danza.distance_traveled.toFixed(1)} km de ${totalRouteLength.toFixed(1)} km`;
            }

            // Actualizar estado
            const statusDiv = item.querySelector('.dance-status');
            if (statusDiv) {
                const statusText = danza.finished ? 'Finalizado' :
                    danza.started ? 'En recorrido' : 'En espera';
                const statusIcon = danza.finished ? '🏁' :
                    danza.started ? '🏃' : '📍';
                statusDiv.innerHTML = `<span>${statusIcon}</span> ${statusText}`;
            }
        }
    });
}

// Actualizar marcadores en el mapa
function updateMapMarkers() {
    console.log('🗺️ Updating map markers for', dansas.length, 'dances');

    // First, remove any markers that no longer exist in the API response
    Object.keys(danceMarkers).forEach(markerId => {
        const stillExists = dansas.some(danza => danza.id === markerId);
        if (!stillExists) {
            map.removeLayer(danceMarkers[markerId]);
            delete danceMarkers[markerId];
        }
    });

    // Update or create markers for each dance
    dansas.forEach(danza => {
        // Only show markers for dances that have started or are not finished
        const shouldShowMarker = danza.started || (danza.distance_traveled > 0 && !danza.finished);

        if (danceMarkers[danza.id]) {
            // Markers exist, update position if they should be visible
            if (shouldShowMarker) {
                // Update position
                const newLatLng = [danza.lat, danza.lng];
                console.log(`📍 Updating ${danza.name} to [${danza.lat}, ${danza.lng}], progress: ${danza.progress}%`);
                danceMarkers[danza.id].setLatLng(newLatLng);

                // Update popup content
                danceMarkers[danza.id].setPopupContent(`
                    <div style="text-align: center;">
                        <h3 style="color: ${danza.color}; margin-bottom: 5px;">${danza.name}</h3>
                        <p><strong>Tipo:</strong> ${danza.type}</p>
                        <p><strong>Progreso:</strong> ${danza.progress.toFixed(1)}%</p>
                        <p><strong>Distancia:</strong> ${danza.distance_traveled.toFixed(2)} km</p>
                    </div>
                `);

                // Show marker if it was hidden
                if (!map.hasLayer(danceMarkers[danza.id])) {
                    danceMarkers[danza.id].addTo(map);
                }
            } else {
                // Remove marker if it shouldn't be visible
                if (map.hasLayer(danceMarkers[danza.id])) {
                    map.removeLayer(danceMarkers[danza.id]);
                }
            }
        } else if (shouldShowMarker) {
            // Create new marker only if it should be visible
            console.log(`➕ Creating marker for ${danza.name} at [${danza.lat}, ${danza.lng}]`);
            const icon = L.divIcon({
                html: `<div style="font-size: 28px; color: ${danza.color}; text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">${danza.icon || '💃'}</div>`,
                className: 'custom-dance-icon',
                iconSize: [35, 35],
                iconAnchor: [17, 17]
            });

            const marker = L.marker([danza.lat, danza.lng], {
                icon: icon
            }).addTo(map);

            marker.bindPopup(`
                <div style="text-align: center; min-width: 200px;">
                    <h3 style="color: ${danza.color}; margin-bottom: 5px; font-size: 1.1em;">${danza.name}</h3>
                    <p><strong>Tipo:</strong> ${danza.type}</p>
                    <p><strong>Progreso:</strong> ${danza.progress.toFixed(1)}%</p>
                    <p><strong>Distancia:</strong> ${danza.distance_traveled.toFixed(2)} km</p>
                </div>
            `);

            // Add click event to center map on marker
            marker.on('click', function () {
                map.setView([danza.lat, danza.lng], map.getZoom());
            });

            danceMarkers[danza.id] = marker;
        }
    });

    // If there are active dances, adjust map view to show them
    const activeDances = dansas.filter(d => d.started && !d.finished);
    if (activeDances.length > 0) {
        // Focus on the map to follow active dances
        const activePositions = activeDances.map(d => [d.lat, d.lng]);
        if (activePositions.length > 0) {
            const bounds = L.latLngBounds(activePositions);
            // Only adjust bounds if they are valid and not too zoomed out
            if (bounds.isValid() && bounds.getNorthEast() && bounds.getSouthWest()) {
                // Add some padding to ensure markers are not too close to the edge
                map.fitBounds(bounds, { padding: [50, 50], maxZoom: 16 });
            }
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', async () => {
    await initMap();

    // Auto-start any dances that haven't been started yet after a delay
    setTimeout(autoStartDances, 2000);
});

// Function to auto-start dances that haven't been started
async function autoStartDances() {
    try {
        const response = await fetch(`${API_BASE_URL}/dances`);
        if (response.ok) {
            const dances = await response.json();
            const unstartedDances = dances.filter(d => !d.started && !d.finished);

            if (unstartedDances.length > 0) {
                console.log(`🎬 Auto-starting ${unstartedDances.length} dances...`);

                // Start each unstarted dance
                for (const dance of unstartedDances) {
                    const startResponse = await fetch(`${API_BASE_URL}/start-dance/${dance.id}`, {
                        method: 'POST'
                    });

                    if (startResponse.ok) {
                        console.log(`✅ Started dance: ${dance.name}`);
                    } else {
                        console.error(`❌ Failed to start dance: ${dance.name}`, startResponse.status);
                    }
                }
            }
        }
    } catch (error) {
        console.error('❌ Error auto-starting dances:', error);
    }
}