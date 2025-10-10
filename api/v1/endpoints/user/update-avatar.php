<?php

$config = require_once __DIR__ . '/../../core/config.php';
require_once __DIR__ . '/../../core/database.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['user_id'];

if (!isset($_FILES['avatar'])) {
    http_response_code(400);
    echo json_encode(['message' => 'No avatar file provided.']);
    exit();
}

$file = $_FILES['avatar'];

// Basic file validation
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($file['type'], $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.']);
    exit();
}

if ($file['size'] > 5 * 1024 * 1024) { // 5 MB limit
    http_response_code(400);
    echo json_encode(['message' => 'File is too large. Maximum size is 5 MB.']);
    exit();
}

// Generate a unique filename
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid('avatar_', true) . '.' . $extension;
$uploadPath = PROJECT_ROOT . 'api/uploads/avatars/' . $filename;

// Move the file
if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    http_response_code(500);
    $error = error_get_last();
    error_log("File upload failed: " . print_r($error, true));
    echo json_encode(['message' => 'Failed to save uploaded file. Check server logs for details.']);
    exit();
}

// Construct the URL to be stored in the database
$avatarUrl = '/api/uploads/avatars/' . $filename;

try {
    $db = Database::getInstance($config)->getConnection();

    $stmt = $db->prepare("UPDATE users SET avatar_url = :avatar_url WHERE id = :id");
    $stmt->execute(['avatar_url' => $avatarUrl, 'id' => $userId]);

    http_response_code(200);
    echo json_encode(['message' => 'Avatar updated successfully.', 'avatar_url' => $avatarUrl]);

} catch (Exception $e) {
    // If something goes wrong, delete the uploaded file
    if (file_exists($uploadPath)) {
        unlink($uploadPath);
    }
    http_response_code(500);
    echo json_encode(['message' => 'Avatar update failed: ' . $e->getMessage()]);
}
