<?php
/**
 * Supabase Token Validation Middleware
 * 
 * Validates Supabase access tokens from cookies and returns user data.
 * Used to authenticate API requests without relying on local MySQL tables.
 * 
 * @version 2.0.0
 */

// Supabase Configuration
define('SUPABASE_URL', 'https://lwreqclamvezlpfryjaz.supabase.co');
define('SUPABASE_ANON_KEY', 'sb_publishable_kfUeXOlkfU8kHP8AHBkATw_LoWC3cwZ');
define('SB_COOKIE_NAME', 'sb-access-token');

/**
 * Get Supabase access token from cookie or Authorization header
 * 
 * @return string|null Access token or null if not found
 */
function getSupabaseToken()
{
    // 1. Try cookie first (set by supabase-core.js)
    if (isset($_COOKIE[SB_COOKIE_NAME]) && !empty($_COOKIE[SB_COOKIE_NAME])) {
        return $_COOKIE[SB_COOKIE_NAME];
    }

    // 2. Fallback to Authorization header
    $authHeader = null;

    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    } elseif (function_exists('apache_request_headers')) {
        $headers = apache_request_headers();
        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'authorization') {
                $authHeader = $value;
                break;
            }
        }
    }

    if ($authHeader && preg_match('/Bearer\s+(.+)/i', $authHeader, $matches)) {
        return trim($matches[1]);
    }

    return null;
}

/**
 * Validate Supabase token and get user data
 * 
 * @param string|null $token Access token (optional, will try to get from cookie/header)
 * @return array User data array with 'id', 'email', 'user_metadata', etc.
 * @throws Exception If token is invalid or API call fails
 */
function validateSupabaseToken($token = null)
{
    if (!$token) {
        $token = getSupabaseToken();
    }

    if (!$token) {
        throw new Exception('No authentication token provided', 401);
    }

    // Call Supabase Auth API to validate token and get user
    $url = SUPABASE_URL . '/auth/v1/user';

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $token,
            'apikey: ' . SUPABASE_ANON_KEY,
            'Content-Type: application/json'
        ],
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        throw new Exception('Failed to connect to Supabase: ' . $error, 500);
    }

    $data = json_decode($response, true);

    if ($httpCode === 401 || (isset($data['error']) && $data['error'])) {
        $errorMsg = $data['error_description'] ?? $data['message'] ?? 'Invalid or expired token';
        throw new Exception($errorMsg, 401);
    }

    if ($httpCode !== 200 || !isset($data['id'])) {
        throw new Exception('Unexpected Supabase response', 500);
    }

    // Return normalized user object
    return [
        'id' => $data['id'],  // UUID
        'email' => $data['email'] ?? null,
        'name' => $data['user_metadata']['full_name'] ?? $data['user_metadata']['name'] ?? null,
        'picture' => $data['user_metadata']['avatar_url'] ?? $data['user_metadata']['picture'] ?? null,
        'provider' => $data['app_metadata']['provider'] ?? 'unknown',
        'email_verified' => $data['email_confirmed_at'] !== null,
        'raw' => $data
    ];
}

/**
 * Require authentication - returns user or sends 401 response
 * 
 * @return array User data
 */
function requireAuth()
{
    try {
        return validateSupabaseToken();
    } catch (Exception $e) {
        http_response_code($e->getCode() ?: 401);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
            'requiresAuth' => true
        ]);
        exit();
    }
}

/**
 * Optional authentication - returns user or null
 * 
 * @return array|null User data or null if not authenticated
 */
function optionalAuth()
{
    try {
        return validateSupabaseToken();
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Check if user is authenticated (without throwing)
 * 
 * @return bool True if valid token exists
 */
function isAuthenticated()
{
    try {
        validateSupabaseToken();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>