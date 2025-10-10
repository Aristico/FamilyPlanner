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

if (!$data || !isset($data->name) || !isset($data->email)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid input. Name and email are required.']);
    exit();
}

$name = trim($data->name);
$email = trim($data->email);

if (empty($name) || empty($email)) {
    http_response_code(400);
    echo json_encode(['message' => 'Name and email cannot be empty.']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid email format.']);
    exit();
}

try {
    $db = Database::getInstance($config)->getConnection();

    // Check if email is already taken by another user
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
    $stmt->execute(['email' => $email, 'id' => $userId]);

    if ($stmt->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(['message' => 'This email is already in use by another account.']);
        exit();
    }

    $stmt = $db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute(['name' => $name, 'email' => $email, 'id' => $userId]);

    // Fetch updated user information to send back to the frontend
    $stmt = $db->prepare("SELECT id, name, email, family_id, avatar_url FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode(['message' => 'Profile updated successfully.', 'user' => $user]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Profile update failed: ' . $e->getMessage()]);
}
