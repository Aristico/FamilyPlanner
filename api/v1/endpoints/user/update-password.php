<?php

$config = require_once __DIR__ . '/../../core/config.php';
require_once __DIR__ . '/../../core/database.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-control-allow-headers: content-type");

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['user_id'];

$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->current_password) || !isset($data->new_password)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid input. Current and new password are required.']);
    exit();
}

$currentPassword = $data->current_password;
$newPassword = $data->new_password;

if (strlen($newPassword) < 8) {
    http_response_code(400);
    echo json_encode(['message' => 'New password must be at least 8 characters long.']);
    exit();
}

try {
    $db = Database::getInstance($config)->getConnection();

    $stmt = $db->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($currentPassword, $user['password'])) {
        http_response_code(401);
        echo json_encode(['message' => 'Incorrect current password.']);
        exit();
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
    $stmt->execute(['password' => $hashedPassword, 'id' => $userId]);

    http_response_code(200);
    echo json_encode(['message' => 'Password updated successfully.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Password update failed: ' . $e->getMessage()]);
}
