<?php

$config = require_once __DIR__ . '/../../core/config.php';
require_once __DIR__ . '/../../core/database.php';

header("Content-Type: application/json");

session_start();

if (!isset($_SESSION['family_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized: No family context']);
    exit();
}

$familyId = $_SESSION['family_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid input.']);
    exit();
}

$date = $data['date'] ?? null;
$mealType = $data['meal_type'] ?? null;
$title = $data['title'] ?? null;
$description = $data['description'] ?? null;
$numAdults = $data['num_adults'] ?? null;
$numChildren = $data['num_children'] ?? null;

if (!$date || !$mealType || !$title) {
    http_response_code(400);
    echo json_encode(['message' => 'Bad Request: Missing required fields.']);
    exit();
}

try {
    $db = Database::getInstance($config)->getConnection();

    $stmt = $db->prepare("
        INSERT INTO meal_plan (family_id, date, meal_type, title, description, num_adults, num_children)
        VALUES (:family_id, :date, :meal_type, :title, :description, :num_adults, :num_children)
    ");

    $stmt->execute([
        'family_id' => $familyId,
        'date' => $date,
        'meal_type' => $mealType,
        'title' => $title,
        'description' => $description,
        'num_adults' => $numAdults,
        'num_children' => $numChildren,
    ]);

    http_response_code(201);
    echo json_encode(['message' => 'Meal plan entry created successfully.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to create meal plan entry: ' . $e->getMessage()]);
}
