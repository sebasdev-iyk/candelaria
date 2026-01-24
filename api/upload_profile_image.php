<?php
// API Endpoint for Profile Image Uploads (Local Storage)
// Path: candelaria/api/upload_profile_image.php

header('Content-Type: application/json');

// 1. Error Handling
ini_set('display_errors', 0);
ini_set('log_errors', 1);

try {
    // 2. Load Dependencies
    // Use Output Buffering to catch stray echos
    ob_start();
    $middlewareFile = '../includes/supabase-middleware.php';

    if (!file_exists($middlewareFile)) {
        throw new Exception("Server configuration error: Missing dependencies");
    }

    require_once $middlewareFile;
    ob_end_clean();

    // 3. Authenticate
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed', 405);
    }

    $user = requireAuth(); // Validates Supabase Token

    if (!$user || empty($user['id'])) {
        throw new Exception('Unauthorized', 401);
    }

    // 4. Check File
    if (!isset($_FILES['image'])) {
        throw new Exception('No image uploaded', 400);
    }

    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    if ($fileError !== 0) {
        throw new Exception('Error uploading file (Code: ' . $fileError . ')');
    }

    // 5. Validate File
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    if (!in_array($fileExt, $allowed)) {
        throw new Exception('Invalid file type. Only JPG, PNG, WEBP, GIF allowed.');
    }

    if ($fileSize > 5 * 1024 * 1024) { // 5MB
        throw new Exception('File too large (Max 5MB)');
    }

    // 6. Security: Check MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $fileTmpName);
    finfo_close($finfo);

    if (strpos($mime, 'image/') !== 0) {
        throw new Exception('Invalid file content. Must be an image.');
    }

    // 7. Prepare Directory
    // Save to: candelaria/assets/uploads/profiles/
    $targetDir = __DIR__ . '/../assets/uploads/profiles/';

    if (!is_dir($targetDir)) {
        if (!@mkdir($targetDir, 0777, true)) {
            // Try to create parent if missing
            $parentDir = __DIR__ . '/../assets/uploads/';
            if (!is_dir($parentDir))
                @mkdir($parentDir, 0777, true);

            if (!@mkdir($targetDir, 0777, true)) {
                throw new Exception('Server error: Could not create upload directory. Check permissions.');
            }
        }
    }

    // 8. Generate Unique Name
    // Use UUID or Time to prevent collisions
    $newFileName = 'profile_' . $user['id'] . '_' . time() . '.' . $fileExt;
    $destination = $targetDir . $newFileName;

    // 9. Move File
    if (move_uploaded_file($fileTmpName, $destination)) {
        // Success!
        // Return absolute path from domain root for frontend use in any directory
        $publicPath = '/candelaria/assets/uploads/profiles/' . $newFileName;

        echo json_encode([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'url' => $publicPath
        ]);

    } else {
        throw new Exception('Failed to write file to disk.');
    }

} catch (Exception $e) {
    $code = $e->getCode();
    http_response_code(is_int($code) && $code >= 400 && $code < 600 ? $code : 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>