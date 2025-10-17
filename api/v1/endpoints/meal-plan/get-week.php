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
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

if (!$startDate || !$endDate) {
    http_response_code(400);
    echo json_encode(['message' => 'Bad Request: Missing start_date or end_date parameter.']);
    exit();
}

try {
    $db = Database::getInstance($config)->getConnection();

    $stmt = $db->prepare("
        SELECT date, meal_type, title, description, num_adults, num_children
        FROM meal_plan
        WHERE family_id = :family_id
        AND date BETWEEN :start_date AND :end_date
    ");

    $stmt->execute([
        'family_id' => $familyId,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ]);

    $mealPlan = $stmt->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode($mealPlan);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to fetch meal plan: ' . $e->getMessage()]);
}
