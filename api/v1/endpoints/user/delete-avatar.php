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

try {
    $db = Database::getInstance($config)->getConnection();

    // First, get the current avatar URL to delete the file
    $stmt = $db->prepare("SELECT avatar_url FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    $currentAvatarUrl = $user ? $user['avatar_url'] : null;

    // Set avatar_url to NULL in the database
    $stmt = $db->prepare("UPDATE users SET avatar_url = NULL WHERE id = :id");
    $stmt->execute(['id' => $userId]);

    // If there was an avatar, delete the file from the server
    if ($currentAvatarUrl) {
        $filePath = PROJECT_ROOT . ltrim($currentAvatarUrl, '/');
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    http_response_code(200);
    echo json_encode(['message' => 'Avatar deleted successfully.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to delete avatar: ' . $e->getMessage()]);
}
