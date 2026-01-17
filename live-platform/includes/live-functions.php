<?php

define('STREAMS_FILE', __DIR__ . '/../data/streams.json');

// --- Helper: Get all streams ---
function getStreams($status = null) {
    if (!file_exists(STREAMS_FILE)) return [];
    
    $json = file_get_contents(STREAMS_FILE);
    $streams = json_decode($json, true) ?? [];
    
    if ($status) {
        return array_filter($streams, fn($s) => $s['status'] === $status);
    }
    
    return $streams;
}

// --- Helper: Get single stream ---
function getStreamById($id) {
    $streams = getStreams();
    $found = array_filter($streams, fn($s) => $s['id'] === $id);
    return !empty($found) ? reset($found) : null;
}

// --- Helper: Save stream (Add/Edit) ---
function saveStream($data) {
    $streams = getStreams();
    $isNew = true;
    
    foreach ($streams as $k => $s) {
        if ($s['id'] === $data['id']) {
            $streams[$k] = array_merge($s, $data);
            $isNew = false;
            break;
        }
    }
    
    if ($isNew) {
        // Generate ID if missing
        if (empty($data['id'])) {
            $data['id'] = uniqid();
        }
        $streams[] = $data;
    }
    
    file_put_contents(STREAMS_FILE, json_encode($streams, JSON_PRETTY_PRINT));
    return $data['id'];
}

// --- Helper: Delete stream ---
function deleteStream($id) {
    $streams = getStreams();
    $newStreams = array_filter($streams, fn($s) => $s['id'] !== $id);
    file_put_contents(STREAMS_FILE, json_encode(array_values($newStreams), JSON_PRETTY_PRINT));
}

function renderEmbed($stream) {
    $platform = strtolower($stream['platform']);
    $id = $stream['embed_id'];
    
    switch ($platform) {
        case 'youtube':
            // $id should be just the video ID: e.g. "aSxjLz3xUgs"
            return "<iframe class='w-full h-full' src='https://www.youtube.com/embed/{$id}?autoplay=1&mute=1&controls=1&enablejsapi=1' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
            
        case 'facebook':
            // Facebook Share URLs (e.g., https://web.facebook.com/share/v/...) might not work directly in the embed plugin.
            // But we will try to pass the full URL or ID.
            $url = $id;
            if (strpos($id, 'http') === FALSE) {
                 // It's just an ID
                 $url = "https://www.facebook.com/watch/?v={$id}";
            }
            // Ensure encoding
            $encodedUrl = urlencode($url);
            return "<iframe class='w-full h-full' src='https://www.facebook.com/plugins/video.php?href={$encodedUrl}&show_text=false&t=0' frameborder='0' allowfullscreen='true' allow='autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share'></iframe>";
            
        case 'tiktok':
             return "<iframe class='w-full h-full' src='https://www.tiktok.com/embed/v2/{$id}?lang=es' frameborder='0'></iframe>";
             
        default:
            return "<div class='w-full h-full flex items-center justify-center bg-black text-white'>Plataforma no soportada</div>";
    }
}
?>
