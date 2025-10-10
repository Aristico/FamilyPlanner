<?php

$config = require_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../core/database.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // For development only. In production, restrict this to your frontend's domain.
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// 1. Get Input Data
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->name) || !isset($data->email) || !isset($data->password)) {
    http_response_code(400); // Bad Request
    echo json_encode(['message' => 'Invalid input. Name, email, and password are required.']);
    exit();
}

$name = trim($data->name);
$email = trim($data->email);
$password = $data->password;

// 2. Validate Input
if (empty($name) || empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(['message' => 'All fields are required.']);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid email format.']);
    exit();
}

if (strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(['message' => 'Password must be at least 8 characters long.']);
    exit();
}

// 3. Create User and Family in a Transaction
try {
    $db = Database::getInstance($config)->getConnection();

    // Check if user already exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        http_response_code(409); // Conflict
        echo json_encode(['message' => 'A user with this email already exists.']);
        exit();
    }

    // Hash Password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $db->beginTransaction();

    // Insert user (without family_id first)
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword]);
    $userId = $db->lastInsertId();

    // Create a family for the new user
    $familyName = $name . "'s Family";
    $stmt = $db->prepare("INSERT INTO families (name, owner_id) VALUES (:name, :owner_id)");
    $stmt->execute(['name' => $familyName, 'owner_id' => $userId]);
    $familyId = $db->lastInsertId();

    // Update the user with the new family_id
    $stmt = $db->prepare("UPDATE users SET family_id = :family_id WHERE id = :id");
    $stmt->execute(['family_id' => $familyId, 'id' => $userId]);

    // Add user to family_members table as owner
    $stmt = $db->prepare("INSERT INTO family_members (family_id, user_id, role) VALUES (:family_id, :user_id, 'owner')");
    $stmt->execute(['family_id' => $familyId, 'user_id' => $userId]);

    $db->commit();

    http_response_code(201); // Created
    echo json_encode(['message' => 'User registered successfully.']);

} catch (Exception $e) {
    // If transaction was started, roll back.
    if (isset($db) && $db->inTransaction()) {
        $db->rollBack();
    }
    http_response_code(500); // Internal Server Error
    echo json_encode(['message' => 'Registration failed: ' . $e->getMessage()]);
}

