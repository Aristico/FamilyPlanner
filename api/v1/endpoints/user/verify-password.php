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
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->current_password)) {
    http_response_code(400);
    echo json_encode(['message' => 'Current password is required.']);
    exit();
}

$currentPassword = $data->current_password;

try {
    $db = Database::getInstance($config)->getConnection();

    $stmt = $db->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($currentPassword, $user['password'])) {
        http_response_code(200);
        echo json_encode(['isValid' => true]);
    } else {
        http_response_code(200);
        echo json_encode(['isValid' => false]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Verification failed: ' . $e->getMessage()]);
}
