<?php
session_start();

require_once __DIR__ . '/../core/database.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // In production, replace * with your frontend's domain
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // Allow cookies to be sent

// 1. Get Input Data
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->email) || !isset($data->password)) {
    http_response_code(400);
    echo json_encode(['message' => 'Email and password are required.']);
    exit();
}

$email = trim($data->email);
$password = $data->password;

// 2. Validate Input
if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['message' => 'Email and password cannot be empty.']);
    exit();
}

// 3. Find User and Verify Password
try {
    $db = Database::getInstance()->getConnection();

    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, start session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['family_id'] = $user['family_id'];

        // Don't send the password hash to the client
        unset($user['password']);

        http_response_code(200);
        echo json_encode([
            'message' => 'Login successful.',
            'user' => $user
        ]);
    } else {
        http_response_code(401); // Unauthorized
        echo json_encode(['message' => 'Invalid email or password.']);
    }

} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['message' => 'Login failed: ' . $e->getMessage()]);
}