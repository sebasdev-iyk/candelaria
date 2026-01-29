<?php

define('STREAMS_FILE', __DIR__ . '/../data/streams.json');

// --- Helper: Get all streams ---
function getStreams($status = null)
{
    if (!file_exists(STREAMS_FILE))
        return [];

    $json = file_get_contents(STREAMS_FILE);
    $streams = json_decode($json, true) ?? [];

    if ($status) {
        return array_filter($streams, fn($s) => $s['status'] === $status);
    }

    return $streams;
}

// --- Helper: Get single stream ---
function getStreamById($id)
{
    $streams = getStreams();
    $found = array_filter($streams, fn($s) => $s['id'] === $id);
    return !empty($found) ? reset($found) : null;
}

// --- Helper: Save stream (Add/Edit) ---
function saveStream($data)
{
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
        if (empty($data['id'])) {
            $data['id'] = uniqid();
        }
        $streams[] = $data;
    }

    file_put_contents(STREAMS_FILE, json_encode($streams, JSON_PRETTY_PRINT));
    return $data['id'];
}

// --- Helper: Delete stream ---
function deleteStream($id)
{
    $streams = getStreams();
    $newStreams = array_filter($streams, fn($s) => $s['id'] !== $id);
    file_put_contents(STREAMS_FILE, json_encode(array_values($newStreams), JSON_PRETTY_PRINT));
}

function renderEmbed($stream)
{
    $platform = strtolower($stream['platform']);
    $id = $stream['embed_id'];

    switch ($platform) {
        case 'youtube':
            return "<iframe class='w-full h-full' src='https://www.youtube.com/embed/{$id}?autoplay=1&mute=1&controls=1&enablejsapi=1' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";

        case 'facebook':
            $url = $id;
            if (strpos($id, 'http') === FALSE) {
                // Determine if it's a numeric ID or a path
                if (is_numeric($id)) {
                    $url = "https://www.facebook.com/watch/?v={$id}";
                } else {
                    // Assume it's a path like 'User/videos/123' if they pasted a partial part
                    $url = "https://www.facebook.com/{$id}";
                }
            }

            // Normalize specific subdomains to www for better embed compatibility
            $url = str_replace(['https://m.facebook.com', 'https://web.facebook.com'], 'https://www.facebook.com', $url);

            $encodedUrl = urlencode($url);
            // Added width=500 to href as sometimes required by plugin, though usually optional. Kept simple.
            return "<iframe class='w-full h-full' src='https://www.facebook.com/plugins/video.php?href={$encodedUrl}&show_text=false&t=0' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowfullscreen='true' allow='autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share'></iframe>";

        case 'tiktok':
            // Support full URL (extract ID) or raw ID
            $videoId = $id;
            if (preg_match('/\/video\/(\d+)/', $id, $matches)) {
                $videoId = $matches[1];
            }
            return "<iframe class='w-full h-full' src='https://www.tiktok.com/embed/v2/{$videoId}?lang=es' frameborder='0'></iframe>";

        default:
            return "<div class='w-full h-full flex items-center justify-center bg-black text-white'>Plataforma no soportada</div>";
    }
}
?>