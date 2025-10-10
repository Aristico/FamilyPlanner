<?php
session_start();

$config = require_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/database.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // In production, replace * with your frontend's domain
header("Access-Control-Allow-Credentials: true");

if (isset($_SESSION['user_id'])) {
    // User is authenticated
    try {
        $db = Database::getInstance($config)->getConnection();
        $stmt = $db->prepare("SELECT id, name, email, family_id, avatar_url FROM users WHERE id = :id");
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();

        if ($user) {
            http_response_code(200);
            echo json_encode([
                'isAuthenticated' => true,
                'user' => $user
            ]);
        } else {
            // User in session not found in DB
            throw new Exception('User not found.');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['isAuthenticated' => false, 'message' => $e->getMessage()]);
    }
} else {
    // User is not authenticated
    http_response_code(200); // It's not an error, just a status check
    echo json_encode(['isAuthenticated' => false]);
}
