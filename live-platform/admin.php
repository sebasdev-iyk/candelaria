<?php
require_once 'includes/live-functions.php';

// Handle Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'save') {
        $data = [
            'id' => $_POST['id'] ?? '',
            'title' => $_POST['title'],
            'streamer' => $_POST['streamer'],
            'platform' => $_POST['platform'],
            'embed_id' => $_POST['embed_id'],
            'thumbnail' => $_POST['thumbnail'],
            'viewers' => (int)$_POST['viewers'],
            'status' => $_POST['status'],
            'category' => $_POST['category']
        ];
        saveStream($data);
        header('Location: admin.php');
        exit;
    }
    
    if ($action === 'delete') {
        deleteStream($_POST['id']);
        header('Location: admin.php');
        exit;
    }
}

$streams = getStreams();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Candelaria Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">

<nav class="bg-purple-900 text-white p-4 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-3">
            <i class="fas fa-satellite-dish text-yellow-400 text-2xl"></i>
            <h1 class="text-xl font-bold tracking-wider">CANDELARIA <span class="text-yellow-400">LIVE ADMIN</span></h1>
        </div>
        <a href="index.php" target="_blank" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
            Ver Plataforma <i class="fas fa-external-link-alt ml-2"></i>
        </a>
    </div>
</nav>

<div class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Form Section -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
            <h2 class="text-xl font-bold mb-4 text-purple-900 border-b pb-2">
                <i class="fas fa-plus-circle mr-2"></i> Gestionar Stream
            </h2>
            <form action="admin.php" method="POST" id="streamForm" class="space-y-4">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" id="field_id">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Título del Stream</label>
                    <input type="text" name="title" id="field_title" required class="w-full p-2 border rounded focus:ring-2 focus:ring-purple-500">
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Canal / Streamer</label>
                    <input type="text" name="streamer" id="field_streamer" required class="w-full p-2 border rounded focus:ring-2 focus:ring-purple-500">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Plataforma</label>
                        <select name="platform" id="field_platform" class="w-full p-2 border rounded bg-white">
                            <option value="youtube">YouTube</option>
                            <option value="facebook">Facebook</option>
                            <option value="tiktok">TikTok</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Categoría</label>
                        <select name="category" id="field_category" class="w-full p-2 border rounded bg-white">
                            <option value="Desfile">Desfile</option>
                            <option value="Concurso">Concurso</option>
                            <option value="Vlog">Vlog</option>
                            <option value="Entrevista">Entrevista</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700">ID de Embed / URL</label>
                    <input type="text" name="embed_id" id="field_embed_id" placeholder="Video ID or Live URL" required class="w-full p-2 border rounded font-mono text-sm bg-gray-50">
                    <p class="text-xs text-gray-500 mt-1">YouTube: Video ID | FB: Video ID | TikTok: Username/ID</p>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700">Thumbnail URL</label>
                    <input type="url" name="thumbnail" id="field_thumbnail" required class="w-full p-2 border rounded focus:ring-2 focus:ring-purple-500">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Viewers Base</label>
                        <input type="number" name="viewers" id="field_viewers" value="1000" class="w-full p-2 border rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Estado</label>
                        <select name="status" id="field_status" class="w-full p-2 border rounded font-bold">
                            <option value="live" class="text-red-600">🔴 EN VIVO</option>
                            <option value="upcoming" class="text-blue-600">📅 Programado</option>
                            <option value="offline" class="text-gray-600">⚫ Offline</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex gap-2 pt-4">
                    <button type="submit" class="flex-1 bg-purple-700 hover:bg-purple-800 text-white py-2 rounded-lg font-bold shadow-md transition">
                        <i class="fas fa-save mr-2"></i> Guardar
                    </button>
                    <button type="button" onclick="resetForm()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700">
                        <i class="fas fa-eraser"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- List Section -->
    <div class="lg:col-span-2 space-y-4">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-purple-600 pl-4 py-1">Streams Activos</h2>
        
        <?php foreach ($streams as $stream): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 group">
                <div class="flex flex-col md:flex-row">
                    <!-- Thumb -->
                    <div class="md:w-48 h-32 relative bg-gray-900">
                        <img src="<?= htmlspecialchars($stream['thumbnail']) ?>" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                        <div class="absolute top-2 left-2 px-2 py-1 rounded text-xs font-bold uppercase text-white
                            <?= $stream['status'] === 'live' ? 'bg-red-600 animate-pulse' : ($stream['status'] === 'upcoming' ? 'bg-blue-600' : 'bg-gray-600') ?>">
                            <?= $stream['status'] ?>
                        </div>
                        <div class="absolute bottom-2 right-2 px-2 py-1 bg-black/70 rounded text-xs text-white">
                            <i class="fab fa-<?= $stream['platform'] ?>"></i>
                        </div>
                    </div>
                    
                    <!-- Info -->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 leading-tight mb-1"><?= htmlspecialchars($stream['title']) ?></h3>
                            <p class="text-sm text-gray-500 font-medium"><?= htmlspecialchars($stream['streamer']) ?> • <span class="text-purple-600"><?= $stream['category'] ?></span></p>
                        </div>
                        
                        <div class="flex justify-end items-center gap-3 mt-4">
                            <button onclick='editStream(<?= json_encode($stream) ?>)' class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md text-sm font-semibold transition">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </button>
                            <form action="admin.php" method="POST" onsubmit="return confirm('¿Eliminar este stream?');" class="inline">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $stream['id'] ?>">
                                <button type="submit" class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md text-sm font-semibold transition">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($streams)): ?>
            <div class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
                <i class="fas fa-video-slash text-6xl text-gray-200 mb-4"></i>
                <p class="text-gray-500 text-lg">No hay streams configurados.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
function editStream(data) {
    document.getElementById('field_id').value = data.id;
    document.getElementById('field_title').value = data.title;
    document.getElementById('field_streamer').value = data.streamer;
    document.getElementById('field_platform').value = data.platform;
    document.getElementById('field_embed_id').value = data.embed_id;
    document.getElementById('field_thumbnail').value = data.thumbnail;
    document.getElementById('field_viewers').value = data.viewers;
    document.getElementById('field_status').value = data.status;
    document.getElementById('field_category').value = data.category;
    
    document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-sync mr-2"></i> Actualizar';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function resetForm() {
    document.getElementById('streamForm').reset();
    document.getElementById('field_id').value = '';
    document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-save mr-2"></i> Guardar';
}
</script>

</body>
</html>
