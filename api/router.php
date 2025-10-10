<?php
// api/router.php

error_log("DEBUG: Router script started.");
error_log("DEBUG: REQUEST_URI: " . $_SERVER['REQUEST_URI']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the /api/ prefix if it exists
if (strpos($path, '/api/') === 0) {
    $path = substr($path, strlen('/api/'));
}

$path = ltrim($path, '/');

error_log("DEBUG: Processed path: " . $path);

// If the path starts with 'v1/endpoints/', then it's an API endpoint
if (strpos($path, 'v1/endpoints/') === 0) {
    $file = __DIR__ . '/' . $path;
    error_log("DEBUG: Attempting to include file: " . $file);
    if (file_exists($file)) {
        require $file;
        exit;
    }
}

// Handle user-specific endpoints
if (strpos($path, 'v1/user/') === 0) {
    $parts = explode('/', $path);
    $endpoint = end($parts);
    $file = __DIR__ . '/v1/endpoints/user/' . $endpoint . '.php';
    error_log("DEBUG: Attempting to include user endpoint file: " . $file);
    if (file_exists($file)) {
        require $file;
        exit;
    }
}

// Handle family-specific endpoints
if (strpos($path, 'v1/family/') === 0) {
    $parts = explode('/', $path);
    $endpoint = end($parts);
    $file = __DIR__ . '/v1/endpoints/family/' . $endpoint . '.php';
    error_log("DEBUG: Attempting to include family endpoint file: " . $file);
    if (file_exists($file)) {
        require $file;
        exit;
    }
}

// Handle static file requests for uploads
if (strpos($path, 'uploads/') === 0) {
    $file = __DIR__ . '/' . $path;
    error_log("DEBUG: Attempting to serve static file: " . $file);
    if (file_exists($file)) {
        // Determine content type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file);
        finfo_close($finfo);

        header("Content-Type: " . $mime_type);
        readfile($file);
        exit;
    }
}

// Fallback for other requests (e.g., static files, or if the endpoint doesn't exist)
return false;
?>