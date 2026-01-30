<?php
/**
 * Cache Clearing Script
 * Run this to clear any server-side caching that might be preventing footer updates
 */

// Clear OPcache if available
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "✅ OPcache cleared<br>";
} else {
    echo "ℹ️ OPcache not available<br>";
}

// Clear any file-based caches
if (function_exists('apc_clear_cache')) {
    apc_clear_cache();
    echo "✅ APC cache cleared<br>";
} else {
    echo "ℹ️ APC cache not available<br>";
}

// Force garbage collection
gc_collect_cycles();
echo "✅ Garbage collection forced<br>";

// Check footer file modification time
$footerFile = __DIR__ . '/includes/standard-footer.php';
if (file_exists($footerFile)) {
    $modTime = filemtime($footerFile);
    echo "📄 Footer file last modified: " . date('Y-m-d H:i:s', $modTime) . "<br>";
    
    // Read a snippet of the footer to verify content
    $content = file_get_contents($footerFile);
    if (strpos($content, 'Sam Zapana') !== false && strpos($content, 'Sebastian Barriga') !== false) {
        echo "✅ Footer contains correct developer names<br>";
    } else {
        echo "❌ Footer does not contain expected developer names<br>";
    }
    
    if (strpos($content, 'Carlos Mendoza') !== false || strpos($content, 'Ana Rodriguez') !== false) {
        echo "❌ Footer still contains old developer names<br>";
    } else {
        echo "✅ Footer does not contain old developer names<br>";
    }
} else {
    echo "❌ Footer file not found<br>";
}

echo "<br><strong>Cache clearing complete!</strong><br>";
echo "<a href='test-footer.php'>Test Footer</a> | <a href='index.php'>Main Page</a>";
?>